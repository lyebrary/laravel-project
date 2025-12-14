<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'EASEPASYO') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-thirds.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/mont" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/front.css') }}"> <!-- Added for your front-end styles -->

    @stack('styles')
    @yield('page-styles')

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-50 text-gray-900" style="background-image: url('{{ asset('images/background-front.png') }}'); background-size: cover; background-position: center; margin: 0; font-family: Poppins, Roboto, sans-serif; line-height: 1.1; display: flex; flex-direction: column; font-size: 1.8rem;">

    <!-- Navbar -->
    <livewire:navbar />

    <main>
        @yield('content') <!-- Pages will yield their specific content here (e.g., .main, .bottom-main) -->
    </main>

    <!-- Footer (shared across pages) -->
    <div class="footer">
        <div class="orange">
            <div class="copyright">
                <h3>STAY IN THE LOOP, STAY IN THE ZONE</h3>
                <h3>©2025 THE THIRD SPACE DILIMAN</h3>
            </div>
            <div class="vl"></div>
            <div class="links">
                <p><a href="#">About Us</a> | <a href="#">FAQs</a></p>
                <div class="socials">
                    <div class="social-item">
                        <img src="{{ URL::asset('/images/facebook-icon.png') }}" alt="facebook icon">
                        <img src="{{ URL::asset('images/instagram-icon.png') }}" alt="instagram-icon">
                        <span>@thirdspace.upd</span>
                    </div>
                    <div class="social-item">
                        <img src="{{ URL::asset('/images/email-icon.png') }}">
                        <span>the.thirdspace.upd@up.edu.ph</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="green"></div>
        <div class="blue"></div>
    </div>

    @livewireScripts

    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>