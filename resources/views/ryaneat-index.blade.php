<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index with Slideshow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Smooth transition effect for slideshow */
        .slide { transition: opacity 1s ease-in-out; }
    </style>
</head>
<body class="bg-gray-100">
<!-- Top Navigation -->
<header class="bg-white shadow-md">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">RyanEat</h1>
        <nav class="space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">Menu</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">Booking</a>
            <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
        </nav>
    </div>
</header>

<!-- Slideshow Section -->
<section class="container mx-auto my-6">
    <div class="relative w-full h-64 overflow-hidden rounded-lg">
        <!-- Slide 1 -->
        <div class="slide absolute w-full h-full bg-blue-500 text-white flex items-center justify-center text-2xl font-bold" id="slide-1">
            Welcome to RyanEat!
        </div>
        <!-- Slide 2 -->
        <div class="slide absolute w-full h-full bg-green-500 text-white flex items-center justify-center text-2xl font-bold opacity-0" id="slide-2">
            Discover Amazing Meal!
        </div>
        <!-- Slide 3 -->
        <div class="slide absolute w-full h-full bg-red-500 text-white flex items-center justify-center text-2xl font-bold opacity-0" id="slide-3">
            Eat Your Favorite food!
        </div>
    </div>
</section>


<!-- Main Content -->
<main class="container mx-auto p-6 flex-1">
    <h2 class="text-3xl font-bold text-center mb-8">Product List</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Product Item -->
        <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">
            <img src="https://via.placeholder.com/150" alt="Product Image" class="w-full h-40 object-cover rounded">
            <div class="mt-4">
                <h3 class="text-lg font-semibold">Product Name</h3>


                <p class="text-gray-600 text-sm mt-1">Short description goes here.</p>
                <div class="flex justify-between items-center mt-4">
                    <span class="font-bold text-blue-500">$50</span>
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Add to Cart</button>
                </div>
            </div>
        </div>
        <!-- Repeat for More Products -->
    </div>
</main>



<!-- JavaScript for Slideshow -->
<script>
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    function showNextSlide() {
        slides[currentIndex].classList.add('opacity-0'); // Hide current slide
        currentIndex = (currentIndex + 1) % slides.length; // Move to next slide
        slides[currentIndex].classList.remove('opacity-0'); // Show next slide
    }

    setInterval(showNextSlide, 3000); // Change slide every 3 seconds
</script>

<!-- Footer -->
<footer class="bg-gray-800 text-white p-4 mt-6 text-center">
    <p>&copy; 2025 My Shop. All rights reserved.</p>
</footer>
</body>
</html>
