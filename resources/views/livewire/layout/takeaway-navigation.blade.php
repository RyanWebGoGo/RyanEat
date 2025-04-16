<nav class="bg-red-500 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">RyanEat Takeaway</h1>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ route('takeaway-home') }}" wire:navigate class="hover:text-gray-200 transition-colors duration-200">Home</a>
            <a href="/menu" class="hover:text-gray-200 transition-colors duration-200">Menu</a>
            <a href="/about" class="hover:text-gray-200 transition-colors duration-200">About</a>
            <a href="/contact" class="hover:text-gray-200 transition-colors duration-200">Contact</a>

            <!-- Dropdown Menu (e.g., User Menu like Breeze) -->
            <div class="relative">
                <button id="dropdown-toggle" class="flex items-center hover:text-gray-200 focus:outline-none">
                    <span>User</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                    <a href="/orders" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Orders</a>
                    <a href="/logout" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
                </div>
            </div>

            <!-- Cart -->
            <a href="{{ route('takeaway-cart') }}" wire:navigate class="flex items-center hover:text-gray-200 transition-colors duration-200">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Cart
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-red-600">
        <div class="container mx-auto py-4 space-y-2">
            <a href="{{ route('takeaway-home') }}" wire:navigate class="block px-4 py-2 hover:text-gray-200 transition-colors duration-200">Home</a>
            <a href="/menu" class="block px-4 py-2 hover:text-gray-200 transition-colors duration-200">Menu</a>
            <a href="/about" class="block px-4 py-2 hover:text-gray-200 transition-colors duration-200">About</a>
            <a href="/contact" class="block px-4 py-2 hover:text-gray-200 transition-colors duration-200">Contact</a>

            <!-- Mobile Dropdown Items -->
            <div class="px-4 py-2">
                <div class="border-t border-red-400 pt-2">
                    <a href="/profile" class="block py-2 hover:text-gray-200">Profile</a>
                    <a href="/orders" class="block py-2 hover:text-gray-200">Orders</a>
                    <a href="/logout" class="block py-2 hover:text-gray-200">Logout</a>
                </div>
            </div>

            <a href="{{ route('takeaway-cart') }}" wire:navigate class="flex items-center px-4 py-2 hover:text-gray-200 transition-colors duration-200">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Cart
            </a>
        </div>
    </div>
</nav>

<!-- JavaScript for Toggle -->
<script>
    // Mobile Menu Toggle
    document.getElementById('mobile-menu-toggle').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });

    // Dropdown Menu Toggle
    document.getElementById('dropdown-toggle').addEventListener('click', function () {
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('dropdown-menu');
        const toggle = document.getElementById('dropdown-toggle');
        if (!toggle.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
