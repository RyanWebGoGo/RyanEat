<div class="container mx-auto px-4 py-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Cart</h1>
    @if (count($cart) > 0)
        <ul class="space-y-4">
            @foreach ($cart as $id => $item)
                <li class="flex items-center justify-between p-4 bg-gray-50 rounded-md shadow-sm hover:bg-gray-100 transition">
                    <div>
                        <span class="text-lg font-medium text-gray-700">{{ $item['name'] }}</span>
                        <span class="block text-sm text-gray-500">${{ number_format($item['price'], 2) }} (Qty: {{ $item['quantity'] }})</span>
                    </div>
                    <button wire:click="removeFromCart({{ $id }})" class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded hover:bg-red-600 transition">
                        Remove
                    </button>
                </li>
            @endforeach
        </ul>
        <div class="mt-6 flex justify-end">
            <a wire:navigate href="{{ route('takeaway-checkout') }}" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">
                Proceed to Checkout - ${{ number_format($total, 2) }}
            </a>
        </div>
    @else
        <p class="text-gray-600 text-lg text-center py-8">Your cart is empty.</p>
    @endif
</div>
