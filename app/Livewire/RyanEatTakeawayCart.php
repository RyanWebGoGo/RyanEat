<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\RyanEatTakeawayCartService;

class RyanEatTakeawayCart extends Component
{
    public $cart = [];
    public $total;

    protected $listeners = ['cartUpdated' => 'refreshCart'];

    public function mount(RyanEatTakeawayCartService $cartService)
    {
        $this->refreshCart($cartService);
    }

    public function refreshCart(RyanEatTakeawayCartService $cartService)
    {
        $this->cart = $cartService->getCart();
    }

    public function removeFromCart($productId, RyanEatTakeawayCartService $cartService)
    {
        $cartService->removeFromCart($productId);
        $this->dispatch('cartUpdated');
    }

    public function getTotal(RyanEatTakeawayCartService $cartService){
        $this->total = $cartService->getTotal();
    }


    public function render()
    {
        $this->total = (new RyanEatTakeawayCartService())->getTotal();
        return view('livewire.ryan-eat-takeaway-cart');
    }

}
