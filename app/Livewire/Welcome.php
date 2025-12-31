<?php

namespace App\Livewire;

use App\Models\StudentProfile;
use App\Models\AttendanceLog;
use App\Models\Operation;
use App\Models\Event;  
use App\Models\OperatingHour;  
use Livewire\Component;

class Welcome extends Component
{
    public $student_number;
    public $current_operation;

    public $events = [];
    public $operatingHours;

    protected $rules = [
        'student_number' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->refreshCurrentOperation();  
        $this->events = Event::all();
        $this->operatingHours = OperatingHour::first();
    }

    protected function resetInput()
    {
        $this->reset('student_number');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    protected function refreshCurrentOperation()
    {
        $this->current_operation = Operation::getCurrent();  
    }

    public function login()
    {
        $this->validate();

        $studentProfile = StudentProfile::where('student_number', $this->student_number)->first();
        if (!$studentProfile) {
            $this->addError('student_number', 'Invalid student number.');
            return;
        }

        $user = $studentProfile->user;
        if (!$user || $user->userType->type_name !== 'student') {
            $this->addError('student_number', 'Access denied.');
            return;
        }

        $openLog = AttendanceLog::where('user_id', $user->id)
            ->whereNull('log_out')
            ->first();

        if ($openLog) {
            $this->addError('general', 'You are currently logged in. Please log out first.');
            return;
        }

        AttendanceLog::create([
            'log_in' => now(),
            'user_id' => $user->id,
            'operation_id' => optional($this->current_operation)->id,  
        ]);

        $this->refreshCurrentOperation();

        session()->flash('success', 'Logged in successfully!');

        $this->resetInput();
    }

    public function logout()
    {
        $this->validate();

        $studentProfile = StudentProfile::where('student_number', $this->student_number)->first();
        if (!$studentProfile) {
            $this->addError('student_number', 'Invalid student number.');
            return;
        }

        $user = $studentProfile->user;

        $openLog = AttendanceLog::where('user_id', $user->id)
            ->whereNull('log_out')
            ->first();

        if (!$openLog) {
            $this->addError('general', 'You are not logged in. Please log in first.');
            return;
        }

        $openLog->update(['log_out' => now()]);

        $this->refreshCurrentOperation();

        session()->flash('success', 'Logged out successfully!');

        $this->resetInput();
    }

    public function getCurrentLoggedInCount()
    {
        if (!$this->current_operation) {
            return 0;  
        }

        return AttendanceLog::where('operation_id', $this->current_operation->id)
            ->whereNull('log_out')
            ->count();
    }

    public function render()
    {
        return view('livewire.welcome', [
            'current_logged_in_count' => $this->getCurrentLoggedInCount(),
            'events' => $this->events,  
            'operatingHours' => $this->operatingHours,  
        ]);
    }
}