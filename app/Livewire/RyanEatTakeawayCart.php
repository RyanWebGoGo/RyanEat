<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class RyanEatTakeawayCart extends Component
{
    public function removeFromCart($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        $cart = Session::get('cart', []);
        return view('livewire.ryan-eat-takeaway-cart', ['cart' => $cart]);
    }

}
