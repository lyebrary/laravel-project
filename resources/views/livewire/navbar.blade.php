<div>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <header class="navbar">
        <div class="left-navbar">
            <div class="logo">
                <img src="{{ asset('images/logo-thirds.png') }}" alt="logo">
            </div>

            <ul>
                <li><a href="#">about</a></li>
                <li><a href="#">faqs</a></li>
            </ul>
        </div>

        <div class="register-container">
            @if (request()->routeIs('register-student') or request()->routeIs('login-admin') or request()->routeIs('register-admin') )
                <a class="register" href="{{ route('welcome') }}" id="return">
                    Return
                </a>
            @else
                <a class="register" href="{{ route('register-student') }}">
                    Register
                </a>
                <a class="register icon-only" href="{{ route('login-admin') }}">
                    <img src="{{ asset('images/admin-con.png') }}"
                         alt="admin icon"
                         class="admin-icon">
                </a>
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
