<div class="manage-users-container">
    <h1 class="manage-users-title">Manage Users</h1>

    <div class="counter-card">
        <div class="counter-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </div>
        <div class="counter-content">
            <div class="counter-number">{{ $totalUsers }}</div>
            <div class="counter-label">Total Registered Users</div>
        </div>
    </div>

    <div class="controls-bar">
        <div class="search-section">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or student number..." class="search-input">
        </div>
        <div class="logout-section">
            <button wire:click="logoutAll" class="logout-all-btn">
                Log Out All Users
            </button>
        </div>
        <div class="delete-section">
            <button wire:click="confirmDeleteSelected" class="delete-selected-btn">
                Delete Selected Users
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if ($showPasswordModal)
        <div class="password-modal-overlay">
            <div class="password-modal">
                <h3 class="password-modal-title">Confirm Deletion</h3>
                <p class="password-modal-text">Enter your password to confirm:</p>
                <input type="password" wire:model="adminPassword" class="password-input" placeholder="Password">
                @error('adminPassword') <span class="password-error">{{ $message }}</span> @enderror
                <div class="password-modal-actions">
                    <button wire:click="executeDelete" class="confirm-btn">Confirm</button>
                    <button wire:click="cancelDelete" class="cancel-btn">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="users-table table-auto">
            <thead class="table-header">
                <tr>
                    <th class="px-4-py-3 text-left">
                        <input type="checkbox" wire:model.live="selectAll" class="form-checkbox">
                    </th>
                    <th class="px-4-py-3 text-left">User (Surname, First Name)</th>
                    <th class="px-4-py-3 text-left">Student Number</th>
                    <th class="px-4-py-3 text-left">College</th>
                    <th class="px-4-py-3 text-left">Degree Program</th>
                    <th class="px-4-py-3 text-left">Date of Registration</th>
                    <th class="px-4-py-3 text-left">Current Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="user-row hover-bg-gray-100" onclick="window.location.href='{{route('user-details', $user['id'])}}'">
                        <td class="px-4-py-3">
                            <input type="checkbox" wire:model.live="selectedUsers" value="{{ $user['id'] }}" class="form-checkbox" onclick="event.stopPropagation()">
                        </td>
                        <td class="px-4-py-3">{{ $user['surname'] }}, {{ $user['first_name'] }}</td>
                        <td class="px-4-py-3">{{ $user['student_number'] }}</td>
                        <td class="px-4-py-3">{{ $user['college'] }}</td>
                        <td class="px-4-py-3">{{ $user['degree_program'] }}</td>
                        <td class="px-4-py-3">{{ $user['registration_date'] }}</td>
                        <td class="px-4-py-3">
                            <span class="px-2-py-1 rounded-full text-sm font-semibold {{ $user['status'] === 'Logged in' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                {{ $user['status'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>