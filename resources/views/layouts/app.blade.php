<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Space</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Nunito from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMPW1K7bsRnhxCTSm6YHe78Fq2i03w5b5x1z5Ka" crossorigin="anonymous">

    <link rel="website-icon" href="{{ asset('icon.png') }}">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            background-image: url("{{ asset('backgroundall.jpg') }}");
            background-size: cover;
            margin: 0;
            overflow: hidden; /* Prevent scrolling on the body */
        }

        nav {
            background: rgb(118, 96, 175);
            border-radius: 0 20px 20px 0;
            padding: 20px;
            width: 250px; /* Fixed width for the sidebar */
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .content {
            flex-grow: 1;
            width: 900px; /* Fixed width for the content area */
            background: #fff;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Use full viewport height */
            margin: 0 auto;
        }

        nav .logo img {
            width: 80%;
            margin: 0 auto 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            padding: 12px 20px;
            display: block;
            margin: 5px 0;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a.active, nav a:hover {
            background: rgb(254, 254, 254);
            color: #000;
        }

        .user-dropdown button {
            width: 100%;
            color: #fff;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            transition: background-color 0.3s;
        }

        .user-dropdown button:hover {
            background-color: #fff;
            color: #000;
        }

        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .flash-message.success {
            background-color: #4CAF50;
            color: white;
        }
        .flash-message.error {
            background-color: #F44336;
            color: white;
        }

        @media (min-width: 1600px) {
            .content {
                width: 900px; /* Fixed width for the content area */
            }

            nav {
                width: 250px; /* Fixed width for the sidebar */
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 flex">
    @include('layouts.navigation') <!-- Sidebar Navigation -->

    <!-- Main content area -->
    <div class="content">
        {{ $slot }} <!-- Dynamic content will be injected here -->
    </div>
</div>

<!-- Flash Messages -->
@if(session('success'))
    <div id="flash-message" class="flash-message success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div id="flash-message" class="flash-message error">
        {{ session('error') }}
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                flashMessage.style.transition = 'opacity 1s';
                setTimeout(() => flashMessage.remove(), 1000); // Adjust the duration as needed
            }, 3000); // Adjust the duration as needed
        }
    });
</script>

</body>
</html>
