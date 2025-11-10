<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - BookLibrary</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    <x-flash-message />
    
    <main class="flex-grow">
        @livewire('cart')
    </main>
    
    <x-footer />
    @livewireScripts
</body>
</html>