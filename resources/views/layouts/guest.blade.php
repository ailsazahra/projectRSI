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
        @vite(['resources/css/regist.css', 'resources/css/welcome.css', 'resources/js/app.js'])
            
    </head>
    <body class="font-sans antialiased dark:bg-white dark:text-white/50">

    <header class="flex justify-between items-center p-4">
        <h3 class="text-black dark:text-black">LeveLink</h3>
        
        @if (Route::has('login'))
            <nav class="flex items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-black dark:text-black mx-2">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-black dark:text-black mx-2">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-black dark:text-black mx-2">Sign Up</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="hero-container">
        <div class="hero-content">
            <h1 >Get Started</h1>
            <p>Welcome to LeveLink — Let’s create your account!</p>
            <hr>
            <!-- Form Section -->
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mr-8">
            {{ $slot }}
        </div>
        </div>
        <div class="hero-image-container">
            <img src="{{ asset('images/elemen6.png') }}" alt="Illustration" />
        
        </div>
    </main>

</body>
</html>
