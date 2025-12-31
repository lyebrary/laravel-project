<div class="venue-container">
    <h1 class="venue-header">Manage Venue</h1>

    @if (session()->has('message'))
        <div class="alert-success">{{ session('message') }}</div>
    @endif

    
    <div class="events-section">
        <h2 class="section-header orange-zone-header">Orange Zone Events</h2>
        <div class="table-container">
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr wire:click="editEvent({{ $event->id }})">
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->start_time->format('H:i') }}</td>
                            <td>{{ $event->end_time->format('H:i') }}</td>
                            <td>
                                <button wire:click.stop="deleteEvent({{ $event->id }})" class="delete-button">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button wire:click="addEvent" class="add-event-button">+ Add Another Event</button>

        
        @if ($showAddEventForm || $editingEventId)
            <div class="event-form-container">
                <h3 class="form-header">{{ $editingEventId ? 'Edit Event' : 'Add Event' }}</h3>
                <form wire:submit.prevent="saveEvent">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Event Name</label>
                            <input wire:model="eventName" type="text" class="form-input">
                            @error('eventName') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Start Time</label>
                            <input wire:model="eventStartTime" type="time" class="form-input">
                            @error('eventStartTime') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">End Time</label>
                            <input wire:model="eventEndTime" type="time" class="form-input">
                            @error('eventEndTime') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="form-button save-button">Save Event</button>
                    <button wire:click="resetEventForm" class="form-button cancel-button">Cancel</button>
                </form>
            </div>
        @endif
    </div>

    
    <div class="operating-hours-section">
        <h2 class="section-header blue-section-header">Operating Hours</h2>
        <div class="operating-hours-container">
            <form wire:submit.prevent="saveOperatingHours">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Start Time</label>
                        <input wire:model="hoursStartTime" type="time" class="form-input">
                        @error('hoursStartTime') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">End Time</label>
                        <input wire:model="hoursEndTime" type="time" class="form-input">
                        @error('hoursEndTime') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="form-button save-button">Save Changes</button>
            </form>
        </div>
    </div>
</div>