<div class="container mx-auto px-4 py-8">
    <h1>Cart</h1>
    @if (count($cart) > 0)
        <ul>
            @foreach ($cart as $id => $item)
                <li>
                    {{ $item['name'] }} - ${{ $item['price'] }} (Qty: {{ $item['quantity'] }})
                    <button wire:click="removeFromCart({{ $id }})" class="text-red-500">Remove</button>
                </li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
