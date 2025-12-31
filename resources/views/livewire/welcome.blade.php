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
            <p>
                <span class="time">{{ $operatingHours ? $operatingHours->start_time->format('g:i') : '9:00' }}</span>{{ $operatingHours ? $operatingHours->start_time->format('A') : 'AM' }} - 
                <span class="time">{{ $operatingHours ? $operatingHours->end_time->format('g:i') : '5:00' }}</span>{{ $operatingHours ? $operatingHours->end_time->format('A') : 'PM' }}
            </p>
        </div>

        <div class="card card-sched">
            <p>ORANGE ZONE</p>
            @foreach ($events as $event)
                <tr wire:click="editEvent({{ $event->id }})">
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->start_time->format('g:i A') }}</td>  
                    <td>{{ $event->end_time->format('g:i A') }}</td>    
                </tr>
            @endforeach
        </div>
    </div>
</div>