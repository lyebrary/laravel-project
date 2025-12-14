<div>
    <div class="logos">
        <img src="{{ asset('images/five-logo.png') }}" alt="office logos">
    </div>
    <h1 class="header-reg">
        Admin Registration Form
    </h1>

    <div class="form-container">
        <form wire:submit.prevent="registerAdmin" class="admin-registration-form">
            <div class="sur-first">
                <div>
                    <label for="surname" class="label-field">Surname</label>
                    <input wire:model="surname" id="surname" class="auth-input" type="text">
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="first_name" class="label-field">First Name</label>
                    <input wire:model="first_name" id="first-name" class="auth-input" type="text">
                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mid-suf">
                <div>
                    <label for="middle_name" class="label-field">Middle Name</label>
                    <input wire:model="middle_name" id="middle-name" class="auth-input" type="text">
                    @error('middle_name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="suffix" class="label-field">Suffix (Jr, II, etc.)</label>
                    <input wire:model="suffix" id="suffix" class="auth-input" type="text">
                    @error('suffix') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="username" class="label-field">Username</label>
                <input wire:model="username" id="username" class="auth-input" type="text">
                @error('username') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="label-field">Password</label>
                <input
                    type="password"
                    id="password"
                    wire:model.defer="password"
                    class="auth-input"
                >
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="data-priv-section">
                <label class="data-priv-label">
                    <input type="checkbox" wire:model="dataPrivacy" class="data-priv-checkbox">
                </label>
                <p class="data-priv-text"><i>I understand and consent to the use of my data for authentication and record-keeping.</i></p>
                @error('dataPrivacy') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="submit-btn">Register</button>
        </form>

        @if (session()->has('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
    </div>
</div>