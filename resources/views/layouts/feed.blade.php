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
    justify-items: center;
    flex-direction: row; /* Align children (nav and main content) in a row */
    min-height: 100vh;
    min-width: 500px;
    background-image: url("background.jpg");
    background-size: cover;
    margin: 0; /* Remove default margin */
}

nav {
    background: rgb(118, 96, 175); /* Purple background */
    border-radius: 0 20px 20px 0; /* Rounded corners on the right */
    padding: 20px;
    width: 250px; /* Fixed width for the sidebar */
    height: 100vh; /* Full height */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Organize space between links and dropdown */
    box-sizing: border-box; /* Include padding and border in the width */
}
.content {
    flex-grow: 1; /* Take up the remaining space */
    min-width: 900px;
    max-width: 900px;/* Maximum width for the content area */
    background: #fff; /* Background color for the content area */
    padding: 20px; /* Padding around the content */
    overflow-y: auto; /* Allows scrolling on y-axis if content overflows */
    display: flex; /* Use flexbox to enable easy centering */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
    min-height: 100vh; /* Minimum height to fill the viewport vertically */
    margin: 0 auto; /* Center the content area within the available flex area */
}




nav .logo img {
    width: 80%; /* Make sure logo is not too wide */
    margin: 0 auto 20px; /* Center logo and provide bottom margin */
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
    width: 100%; /* Ensures the button stretches to fit the nav width */
    color: #fff; /* White text color */
    background: rgba(0, 0, 0, 0.1); /* Slight transparency */
    border: none; /* Removes border */
    border-radius: 10px; /* Rounded corners */
    padding: 12px 20px;
     /* Adds space above the button */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.user-dropdown button:hover {
    background-color: #fff; /* Light background on hover */
    color: #000; /* Dark text on hover */
}


    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <main class="flex">
        @include('layouts.navigation') <!-- Sidebar Navigation -->

        <!-- Main content area -->
       <!-- Main content area -->
<div class="content flex-1">
    {{ $slot }} <!-- Dynamic content will be injected here -->
</div>

    </main>
</div>

</body>
</html>
