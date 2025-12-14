<div class="main">
    <div class="left-main">
        <img src="{{ URL::asset('/images/happy-thirds.png') }}">
    </div>

    <div class="right-main">
        <img src="{{ URL::asset('/images/five-logo.png') }}">
        <h1>find your space in <br> the third space.</h1>
        <form wire:submit.prevent="login">
            <label>Student Number (20XXXXXXX)</label>
            <input type="text" wire:model="student_number" placeholder="Input your student number">
            @error('student_number')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
        </form>

        <div class="user-auth">
            <div class="login" wire:click="login">Log in</div>
            <div class="logout" wire:click="logout">Log out</div>
        </div>
        <p>Haven't registered? <span><a href="{{ route('register-student') }}">Register here.</a></span></p>
        @error('general')
            <div class="alert alert-error">{{ $message }}</div>
        @enderror
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="bottom-main">
        <div class="card card-seats">
            <img src="{{ URL::asset('/images/chair-icon.png') }}" alt="chair-icon" id="chair-icon">
            <p><span class="seat">{{ $current_logged_in_count }}</span> / 250</p>
        </div>

        <div class="card card-time">
            <img src="{{ URL::asset('/images/clock-icon.png') }}" alt="clock-icon" id="clock-icon">
            <p><span class="time">8</span>AM - <span class="time">8</span>PM</p>
        </div>

        <div class="card card-sched">
            <p>ORANGE ZONE</p>
            <p><span class="time-sched">8:00AM-10:00AM</span> UP FLIPP</p>
            <p><span class="time-sched">3:00PM-6:00PM</span> UP Kalilayan</p>
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        </div>
    </div>
</div>