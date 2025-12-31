<div class="user-details-container">
    <h1 class="user-details-title">User Details</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="status-section">
        <h2 class="status-title">Current Status: <span class="status-value">{{ $status }}</span></h2>
        <button wire:click="toggleStatus" class="status-toggle-btn">
            {{ $status === 'Logged in' ? 'Log Out' : 'Log In' }}
        </button>
    </div>

    @if ($editing)
        <form wire:submit="saveChanges" class="edit-form">
            <div class="fields-grid">
                <div class="field-group">
                    <label for="first_name" class="field-label">First Name</label>
                    <input type="text" id="first_name" wire:model="first_name" class="field-input" required>
                    @error('first_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="last_name" class="field-label">Last Name</label>
                    <input type="text" id="last_name" wire:model="last_name" class="field-input" required>
                    @error('last_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="middle_name" class="field-label">Middle Name</label>
                    <input type="text" id="middle_name" wire:model="middle_name" class="field-input">
                    @error('middle_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="suffix" class="field-label">Suffix</label>
                    <input type="text" id="suffix" wire:model="suffix" class="field-input">
                    @error('suffix') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="student_number" class="field-label">Student Number</label>
                    <input type="text" id="student_number" wire:model="student_number" class="field-input" required>
                    @error('student_number') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="year_standing" class="field-label">Year Standing</label>
                    <input type="text" id="year_standing" wire:model="year_standing" class="field-input" required>
                    @error('year_standing') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="college" class="field-label">College</label>
                    <input type="text" id="college" wire:model="college" class="field-input" required>
                    @error('college') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label for="degree_program" class="field-label">Degree Program</label>
                    <input type="text" id="degree_program" wire:model="degree_program" class="field-input" required>
                    @error('degree_program') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field-group">
                    <label class="field-label">Registration Date</label>
                    <p class="field-readonly">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            <div class="edit-actions">
                <button type="submit" class="save-btn">Save Changes</button>
                <button type="button" wire:click="cancelEdit" class="cancel-btn">Cancel</button>
            </div>
        </form>
    @else
        <div class="fields-grid">
            <div class="field-group">
                <label class="field-label">First Name</label>
                <p class="field-value">{{ $first_name }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Last Name (User)</label>
                <p class="field-value">{{ $last_name }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Middle Name</label>
                <p class="field-value">{{ $middle_name }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Suffix</label>
                <p class="field-value">{{ $suffix }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Student Number</label>
                <p class="field-value">{{ $student_number }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Year Standing</label>
                <p class="field-value">{{ $year_standing }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">College</label>
                <p class="field-value">{{ $college }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Degree Program</label>
                <p class="field-value">{{ $degree_program }}</p>
            </div>
            <div class="field-group">
                <label class="field-label">Registration Date</label>
                <p class="field-value">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>
    @endif

    <div class="page-actions">
        <button wire:click="toggleEdit" class="edit-profile-btn">
            {{ $editing ? 'Cancel Edit' : 'Edit Profile' }}
        </button>
        <a href="{{ route('manage-users') }}" class="back-btn">Back to Manage Users</a>
    </div>
</div>