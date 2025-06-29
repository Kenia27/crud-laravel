<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Instrument Sans', sans-serif;
        }

        @media (prefers-color-scheme: light) {
            body {
                background-color: #FDFDFC;
                color: #1b1b18;
            }
        }

        input[type="search"] {
            background-color: rgba(255, 255, 255, 0.07);
            color: #ffffff;
            border: 1px solid #555;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
        }

        input[type="search"]::placeholder {
            color: #d4d4d8;
            opacity: 0.8;
        }

        table thead th {
            background-color: rgba(255, 255, 255, 0.07);
            color: #ffffff;
            font-weight: 600;
            padding: 0.75rem;
        }

        table td {
            color: #f4f4f5;
            padding: 0.75rem;
        }

        /* Aplicar color blanco a todo lo que no sea botones, enlaces ni tablas */
        body *:not(button):not(table):not(th):not(td):not(a):not(.btn):not(.flux-button) {
            color: #ffffff !important;
        }

        h1, h2, h3, h4, h5, h6,
        label, p, span, strong, small, input, select, textarea {
            color: #ffffff !important;
        }

        /* ========== ESTILO DE FORMULARIO COMO EN LA IMAGEN ========== */

        flux\:input, select, input[type="email"], input[type="password"], input[type="text"], input[type="tel"] {
            background-color: #2f2f2f !important;
            color: #fff !important;
            border: 1px solid #444 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem !important;
            font-size: 1rem !important;
            width: 100% !important;
        }

        flux\:input input::placeholder,
        input::placeholder {
            color: #d4d4d8 !important;
            opacity: 0.8 !important;
        }

        select {
            background-color: #2f2f2f !important;
            color: #fff !important;
            border: 1px solid #444 !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem !important;
        }

        label {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
            display: block;
            color: #ccc !important;
        }

        flux\:button, button[type="submit"] {
            background-color: #ffffff !important;
            color: #000000 !important;
            font-weight: 600 !important;
            padding: 0.75rem !important;
            border-radius: 0.5rem !important;
            width: 100% !important;
        }

        .iti {
            width: 100%;
            display: block;
        }

        .iti input {
            background-color: #2f2f2f !important;
            color: #fff !important;
        }

        .iti__flag-container {
            left: 0;
        }

        .iti__country-list,
        .iti__country-name {
            background-color: #2f2f2f !important;
            color: #fff !important;
        }

        .iti__search-input::placeholder {
            color: #9ca3af !important;
            opacity: 1 !important;
        }

        .text-center a {
            color: #ffffff;
            font-weight: 500;
            text-decoration: underline;
        }

        .text-center {
            color: #999;
            font-size: 0.875rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body class="flex flex-col gap-6 p-6 lg:p-8 items-center justify-center min-h-screen">
   <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="px-5 py-2 bg-white text-black font-semibold rounded-md text-sm text-center"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="px-5 py-2 bg-white text-black font-semibold rounded-md text-sm text-center"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="px-5 py-2 bg-white text-black font-semibold rounded-md text-sm text-center"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>


    <!-- Aquí va tu formulario Livewire:usuarios con los estilos ya aplicados -->
    <livewire:usuarios />

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    @vite('resources/js/app.js')
    @livewireScripts
</body>
</html>
