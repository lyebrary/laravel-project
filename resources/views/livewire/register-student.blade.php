<div>
    <div class="logos">
        <img src="{{ asset('images/five-logo.png') }}" alt="office logos">
    </div>
    <h1 class="header-reg">
        Registration Form
    </h1>

    <div class="form-container">
        <form wire:submit.prevent="studentRegister" class="student-registration-form">
            <div class="sur-first">
                <div>
                    <label for="surname" class="label-field">Surname</label>
                    <input wire:model="surname" id="surname" class="auth-input">
                    @error('surname') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="first_name" class="label-field">First Name</label>
                    <input wire:model="first_name" id="first-name" class="auth-input">
                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mid-suf">
                <div>
                    <label for="middle_name" class="label-field">Middle Name</label>
                    <input wire:model="middle_name" id="middle-name" class="auth-input">
                    @error('middle_name') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="suffix" class="label-field">Suffix (Jr, II, etc.)</label>
                    <input wire:model="suffix" id="suffix" class="auth-input"> 
                    @error('suffix') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="username" class="label-field">Username</label>
                <input wire:model="username" id="username" class="auth-input">
                @error('username') <span class="error">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="student_number" class="label-field">Student Number</label>
                <input wire:model="student_number" id="student_number" class="auth-input" placeholder="e.g., 2021001">
                @error('student_number') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="year_standing" class="label-field">Year Standing</label>
                <select wire:model="year_standing" id="year_standing" class="auth-input">
                    <option value="">Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="5th Year">5th Year</option>
                </select>
                @error('year_standing') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="college" class="label-field">College</label>
                <input wire:model="college" id="college" class="auth-input" placeholder="e.g., School of Library and Information Science">
                @error('college') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="degree_program" class="label-field">Degree Program</label>
                <input wire:model="degree_program" id="degree_program" class="auth-input" placeholder="e.g., B Library and Information Science">
                @error('degree_program') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="label-field">Email (Optional)</label>
                <input type="email" wire:model="email" id="email" class="auth-input" placeholder="ltaductante@up.edu.ph">
                @error('email') <span class="error">{{ $message }}</span> @enderror
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