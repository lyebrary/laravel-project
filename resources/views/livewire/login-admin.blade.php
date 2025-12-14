<div class="login-page">
    <div class="login-container">
        <h1 class="title">
            <span class="blue-span">The</span>
            <span class="orange-span">Third</span>
            <span class="green-span">Space</span><br>
            <span class="dark-span">Admin Dashboard</span>
        </h1>

        <div class="login-card">
            <form wire:submit.prevent="login">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        wire:model.defer="username"
                        placeholder="admin"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        wire:model.defer="password"
                        placeholder="************"
                    >
                </div>

                <button type="submit" class="login-btn">
                    Log in
                </button>

            </form>
            <p>Haven't registered? <span><a href="{{ route('register-student') }}">Register here.</a></span></p>
        </div>

    </div>
</div>
