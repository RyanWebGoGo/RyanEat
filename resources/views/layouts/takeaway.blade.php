<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App') - RyanEat.co.uk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

<livewire:layout.takeaway-navigation />

<main>
    @yield('content')
</main>

@livewireScripts
</body>
</html>
