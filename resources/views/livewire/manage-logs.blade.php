<div class="manage-logs-container">
    <div class="filters-card">
        <h2>Attendance Logs</h2>
        <div class="filters">
            <div class="filter-group">
                <label for="selectedDate">Select Date:</label>
                <input type="date" wire:model.live="selectedDate" id="selectedDate" class="filter-input">
            </div>
            <div class="filter-group">
                <label for="startTime">Start Time:</label>
                <input type="time" wire:model.live="startTime" id="startTime" class="filter-input">
            </div>
            <div class="filter-group">
                <label for="endTime">End Time:</label>
                <input type="time" wire:model.live="endTime" id="endTime" class="filter-input">
            </div>
        </div>
    </div>

    <div class="table-card">
        <table class="logs-table">
            <thead>
                <tr>
                    <th>Log Id</th>
                    <th>User:</th>
                    <th>Student number</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actions as $action)
                    <tr>
                        <td>{{ $action['id'] }}</td>
                        <td>{{ $action['user_name'] }}</td>
                        <td>{{ $action['student_number'] }}</td>
                        <td>
                            <span class="rounded-lg py-1 px-2 {{ $action['action'] === 'Log In' ? 'bg-green-200' : 'bg-red-200'}}">{{ $action['action'] }}</span>
                        </td>
                        <td>{{ $action['date'] }}</td>
                        <td>{{ $action['time'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-data">No logs found for the selected filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $actions->links() }}
        </div>
    </div>
</div>