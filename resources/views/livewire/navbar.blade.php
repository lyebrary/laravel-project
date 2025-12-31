<div>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <header class="navbar">
        <div class="left-navbar">
            <div class="logo">
                <a href="{{ route('welcome') }}" class="home-link">
                    <img src="{{ asset('images/logo-thirds.png') }}" alt="logo">
                </a>
            </div>

            <ul>
                <li><a href="{{route('manage-users')}}">users</a></li>
                <li><a href="{{route('manage-logs')}}">logs</a></li>
                <li><a href="{{route('manage-venue')}}">venue</a></li>
            </ul>
        </div>
        <div class="register-container">
            @if (request()->routeIs('register-student') or request()->routeIs('login-admin') or request()->routeIs('register-admin'))
                <a class="register" href="{{ route('welcome') }}" id="return">
                    Return
                </a>
            @else
                @guest
                    <a class="register" href="{{ route('register-student') }}">
                        Register
                    </a>
                    <a class="register icon-only" href="{{ route('login-admin') }}">
                        <img src="{{ asset('images/admin-con.png') }}"
                             alt="admin icon"
                             class="admin-icon">
                    </a>
                @else
                    <a class="register icon-only" href="{{ route('manage-logs') }}">
                        <img src="{{ asset('images/admin-con.png') }}"
                             alt="admin icon"
                             class="admin-icon">
                    </a>
                    <a class="register icon-only" href="{{route('welcome')}}" wire:click.prevent="logout">
                        <img src="{{ asset('images/logout.png') }}"
                             alt="logout icon"
                             class="admin-icon">
                    </a>
                @endguest
            @endif
        </div>
    </header>

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</div>