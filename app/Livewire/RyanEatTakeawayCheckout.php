<?php

namespace App\Livewire;

use Livewire\Component;

use App\Services\RyanEatTakeawayCartService;

class RyanEatTakeawayCheckout extends Component
{

    public $cart = [];
    public $total;


    public function mount(RyanEatTakeawayCartService $cartService){
        $this->cart = $cartService->getCart();
    }

    public function render()
    {
        return view('livewire.ryan-eat-takeaway-checkout');
    }
}
