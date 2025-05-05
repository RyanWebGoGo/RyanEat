<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class RyanEatTakeawayCartService
{
    public function getCart()
    {
        return Session::get('cart', []);
    }

    public function getTotal()
    {
        $cart = $this->getCart();
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    }

    public function removeFromCart($productId){

        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return $cart;

    }

}
