<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library App</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Hero Section Livewire -->
    @livewire('hero-section')

    <!-- Footer Component -->
    <x-footer />

    @livewireScripts
</body>
</html>
