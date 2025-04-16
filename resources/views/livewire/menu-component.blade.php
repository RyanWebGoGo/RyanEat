<div class="container mx-auto px-4 py-8">
    <!-- Categories Navigation -->
    <div class="flex flex-wrap gap-2 mb-6">
        <button
            wire:click="selectCategory(null)"
            class="px-4 py-2 rounded-full {{ !$selectedCategory ? 'bg-red-500 text-white' : 'bg-gray-200' }} flex items-center justify-center gap-2"
        >
            All
            <span wire:loading wire:target="selectCategory(null)" class="inline-block">
                <svg class="animate-spin h-4 w-4 {{ !$selectedCategory ? 'text-white' : 'text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8h8a8 8 0 01-16 0z"></path>
                </svg>
            </span>
        </button>
        @foreach($categories as $category)
            <button
                wire:click="selectCategory({{ $category->id }})"
                class="px-4 py-2 rounded-full {{ $selectedCategory === $category->id ? 'bg-red-500 text-white' : 'bg-gray-200' }} flex items-center justify-center gap-2"
            >
                {{ $category->name }}
                <span wire:loading wire:target="selectCategory({{ $category->id }})" class="inline-block">
                    <svg class="animate-spin h-4 w-4 {{ $selectedCategory === $category->id ? 'text-white' : 'text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8h8a8 8 0 01-16 0z"></path>
                    </svg>
                </span>
            </button>
        @endforeach
    </div>

    <!-- Menu Items Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
            <div
                wire:click="showItemDetails({{ $item->id }})"
                class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow"
            >
                <img
                    src="{{ asset('storage/' . $item->image) }}"
                    alt="{{ $item->name }}"
                    class="w-full h-48 object-cover"
                >
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold">{{ $item->name }}</h3>
                        <div class="flex gap-2">
                            @if($item->is_veg)
                                <span class="text-green-500">Veg</span>
                            @endif
                            @if($item->is_spicy)
                                <span class="text-red-500">🌶️</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mt-1">{{ $item->description }}</p>

                    <div class="mt-2 flex items-center gap-2">
                        @if($item->discount_price)
                            <span class="text-gray-500 line-through">${{ $item->price }}</span>
                            <span class="text-red-500 font-bold">${{ $item->discount_price }}</span>
                        @else
                            <span class="text-red-500 font-bold">${{ $item->price }}</span>
                        @endif
                    </div>

                    <div class="mt-2 text-sm text-gray-500">
                        Ready in: {{ $item->time_for_cook }} mins
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <!-- Item Detail Modal -->
    @if($selectedItem)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click.self="closeModal">
            <div class="bg-white rounded-lg shadow-lg max-w-lg p-6 relative" wire:click.stop>
                <!-- Close Button -->
                <button
                    wire:click="closeModal"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <img
                    src="{{ asset('storage/' . $selectedItem->image) }}"
                    alt="{{ $selectedItem->name }}"
                    class="w-full h-64 object-cover rounded-t-lg"
                >
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h2 class="text-2xl font-bold">{{ $selectedItem->name }}</h2>
                        <div class="flex gap-2">
                            @if($selectedItem->is_veg)
                                <span class="text-green-500">Veg</span>
                            @endif
                            @if($selectedItem->is_spicy)
                                <span class="text-red-500">🌶️</span>
                            @endif
                            @if($selectedItem->is_featured)
                                <span class="text-yellow-500">★ Featured</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 mt-2">{{ $selectedItem->description }}</p>

                    <div class="mt-4 flex items-center gap-2">
                        @if($selectedItem->discount_price)
                            <span class="text-gray-500 line-through">${{ $selectedItem->price }}</span>
                            <span class="text-red-500 font-bold">${{ $selectedItem->discount_price }}</span>
                        @else
                            <span class="text-red-500 font-bold">${{ $selectedItem->price }}</span>
                        @endif
                    </div>

                    <div class="mt-2 text-sm text-gray-500">
                        Ready in: {{ $selectedItem->time_for_cook }} mins
                    </div>

                    <button wire:click="addToCart({{$selectedItem->id}})" class="mt-4 w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
