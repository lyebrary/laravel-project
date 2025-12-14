<div class="main">
    <div class="left-main">
        <img src="{{ URL::asset('/images/happy-thirds.png') }}">
    </div>

    <div class="right-main">
        <img src="{{ URL::asset('/images/five-logo.png') }}">
        <h1>find your space in <br> the third space.</h1>
        <form action="#">
            <label>Student Number (20XXXXXXX)</label>
            <input type="text" name="Input your student number">
        </form>

        <div class="user-auth">
            <div class="login">Log in</div>
            <div class="logout">Log out</div>
        </div>
        <p>Haven't registered? <span><a href="{{ route('register-student') }}">Register here.</a></span></p>
    </div>

    <div class="bottom-main">
        <div class="card card-seats">
            <img src="{{ URL::asset('/images/chair-icon.png') }}" alt="chair-icon" id="chair-icon">
            <p><span class="seat">87</span> / <span class="seat">250</span></p>
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
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
            <p><span class="time-sched">6:00PM-8:00PM</span> Available</p>
        </div>
    </div>
</div>