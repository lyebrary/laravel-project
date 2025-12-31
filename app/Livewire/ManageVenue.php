<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\OperatingHour;
use Livewire\Component;

class ManageVenue extends Component
{
    public $events = [];
    public $operatingHours;
    public $showAddEventForm = false;
    public $editingEventId = null;

    public $eventName = '';
    public $eventStartTime = '';
    public $eventEndTime = '';
    public $hoursStartTime = '';
    public $hoursEndTime = '';

    protected $rules = [
        'eventName' => 'required|string|max:255',
        'eventStartTime' => 'required|date_format:H:i',
        'eventEndTime' => 'required|date_format:H:i|after:eventStartTime',
        'hoursStartTime' => 'required|date_format:H:i',
        'hoursEndTime' => 'required|date_format:H:i|after:hoursStartTime',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->events = Event::all();
        $this->operatingHours = OperatingHour::first();
        if ($this->operatingHours) {
            $this->hoursStartTime = $this->operatingHours->start_time->format('H:i');
            $this->hoursEndTime = $this->operatingHours->end_time->format('H:i');
        }
    }

    public function addEvent()
    {
        $this->resetEventForm();
        $this->showAddEventForm = true;
    }

    public function editEvent($eventId)
    {
        $event = Event::find($eventId);
        if ($event) {
            $this->editingEventId = $eventId;
            $this->eventName = $event->name;
            $this->eventStartTime = $event->start_time->format('H:i');
            $this->eventEndTime = $event->end_time->format('H:i');
        }
    }

    public function saveEvent()
    {
        $this->validate([
            'eventName' => 'required|string|max:255',
            'eventStartTime' => 'required|date_format:H:i',
            'eventEndTime' => 'required|date_format:H:i|after:eventStartTime',
        ]);

        if ($this->editingEventId) {
            $event = Event::find($this->editingEventId);
            $event->update([
                'name' => $this->eventName,
                'start_time' => $this->eventStartTime,
                'end_time' => $this->eventEndTime,
            ]);
        } else {
            Event::create([
                'name' => $this->eventName,
                'start_time' => $this->eventStartTime,
                'end_time' => $this->eventEndTime,
            ]);
        }

        $this->resetEventForm();
        $this->loadData();
        session()->flash('message', 'Event saved successfully.');
    }

    public function deleteEvent($eventId)
    {
        Event::find($eventId)->delete();
        $this->loadData();
        session()->flash('message', 'Event deleted.');
    }

    public function saveOperatingHours()
    {
        $this->validate([
            'hoursStartTime' => 'required|date_format:H:i',
            'hoursEndTime' => 'required|date_format:H:i|after:hoursStartTime',
        ]);

        if ($this->operatingHours) {
            $this->operatingHours->update([
                'start_time' => $this->hoursStartTime,
                'end_time' => $this->hoursEndTime,
            ]);
        } else {
            OperatingHour::create([
                'start_time' => $this->hoursStartTime,
                'end_time' => $this->hoursEndTime,
            ]);
        }

        $this->loadData();
        session()->flash('message', 'Operating hours updated.');
    }

    public function resetEventForm()
    {
        $this->eventName = '';
        $this->eventStartTime = '';
        $this->eventEndTime = '';
        $this->showAddEventForm = false;
        $this->editingEventId = null;
    }

    public function render()
    {
        return view('livewire.manage-venue');
    }
}