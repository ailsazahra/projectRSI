<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LeveLink</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/welcome.css', 'resources/js/app.js'])
            
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <header class="flex justify-between items-center p-4">
        <h3 class="text-black dark:text-white">LeveLink</h3>
        
        @if (Route::has('login'))
            <nav class="flex items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-black dark:text-white mx-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-black dark:text-white mx-2">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-black dark:text-white mx-2">Sign Up</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="hero-container">
    <div class="hero-content">
        <h1 >Link with People and Level Up Your Journey!</h1>
        <p>LeveLink is your gateway to connect with peer mentors and elevate your academic or career journey — join now and start achieving more!</p>
        <a href="{{ route('register') }}" class="cta-button">Get Started</a>
    </div>
    <div class="hero-image-container">
        <img src="{{ asset('images/elemen6.png') }}" alt="Illustration" />
       
    </div>
</main>

</body>
</html>
