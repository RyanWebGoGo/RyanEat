<div class="container mx-auto px-4 py-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>
    @if (count($cart) > 0)
        <ul class="space-y-4">
            @foreach ($cart as $id => $item)
                <li class="flex items-center justify-between p-4 bg-gray-50 rounded-md shadow-sm hover:bg-gray-100 transition">
                    <div>
                        <span class="text-lg font-medium text-gray-700">{{ $item['name'] }}</span>
                        <span class="block text-sm text-gray-500">${{ number_format($item['price'], 2) }} (Qty: {{ $item['quantity'] }})</span>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-8 flex justify-end items-center space-x-4">
            <div class="flex items-center bg-gray-100 text-gray-800 font-semibold text-lg px-6 py-3 rounded-lg shadow-sm">
                <span class="mr-2">Total:</span>
                <span class="text-blue-600">${{ number_format($total, 2) }}</span>
            </div>
            <a wire:navigate href="{{ route('takeaway-checkout') }}" class="flex items-center px-6 py-3 bg-blue-500 text-white font-semibold text-lg rounded-lg hover:bg-blue-600 transition shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Order Confirm
            </a>
        </div>
    @else
        <p class="text-gray-600 text-lg text-center py-8">Your cart is empty.</p>
    @endif
</div>
