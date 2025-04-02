<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans">
<!-- Header -->
<header class="fixed w-full bg-white z-50 shadow-sm">
    <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
        <div class="text-2xl font-bold">The Restaurant</div>
        <div class="hidden md:flex space-x-8">
            <a href="#" class="hover:text-gray-600">Home</a>
            <a href="#" class="hover:text-gray-600">Menu</a>
            <a href="#" class="hover:text-gray-600">Book</a>
            <a href="#" class="hover:text-gray-600">About</a>
            <a href="#" class="hover:text-gray-600">Contact</a>
        </div>
        <button class="md:hidden">Menu</button>
    </nav>
</header>

<!-- Hero Section -->
<section class="h-screen relative">
    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <img src="https://placehold.co/1920x1080/FF0000/FFFFFF?text=Image+1" alt="Restaurant" class="w-full h-full object-cover">
    <div class="absolute inset-0 flex items-center justify-center z-20">
        <div class="text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-4">Welcome</h1>
            <p class="text-xl mb-6">Experience fine dining in elegant surroundings</p>
            <a href="#" class="bg-white text-black px-6 py-3 hover:bg-gray-100">Book Now</a>
        </div>
    </div>
</section>

<!-- Intro Section -->
<section class="py-20 bg-gray-100">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">A Culinary Experience</h2>
            <p class="text-lg text-gray-600 mb-8">
                Our restaurant offers a unique dining experience combining seasonal
                ingredients with innovative cooking techniques in a beautiful setting.
            </p>
            <a href="#" class="border border-black px-6 py-3 hover:bg-black hover:text-white">
                Discover More
            </a>
        </div>
    </div>
</section>

<!-- Two Column Section -->
<section class="py-20">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12">
        <div>
            <img src="https://placehold.co/600x400" alt="Food" class="w-full h-[400px] object-cover">
        </div>
        <div class="flex flex-col justify-center">
            <h3 class="text-3xl font-bold mb-4">Our Menu</h3>
            <p class="text-gray-600 mb-6">
                Carefully crafted dishes using locally sourced ingredients,
                prepared by our award-winning chefs.
            </p>
            <a href="#" class="text-black border-b border-black pb-1 w-fit hover:border-none">
                View Menu
            </a>
        </div>
    </div>
</section>

<!-- Booking Section -->
<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Book Your Table</h2>
        <p class="text-lg mb-8 max-w-2xl mx-auto">
            Join us for an unforgettable dining experience. Reserve your table today.
        </p>
        <a href="#" class="bg-white text-black px-6 py-3 hover:bg-gray-100">
            Make a Reservation
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white py-12">
    <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8">
        <div>
            <h4 class="text-xl font-bold mb-4">The Restaurant</h4>
            <p class="text-gray-400">123 Dining Street<br>Foodville, FV 12345</p>
        </div>
        <div>
            <h4 class="text-xl font-bold mb-4">Hours</h4>
            <p class="text-gray-400">Tue-Sat: 12pm-10pm<br>Sun: 12pm-8pm</p>
        </div>
        <div>
            <h4 class="text-xl font-bold mb-4">Contact</h4>
            <p class="text-gray-400">hello@restaurant.com<br>(555) 123-4567</p>
        </div>
    </div>
</footer>
</body>
</html>
