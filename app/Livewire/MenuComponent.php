<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Item;

use Illuminate\Support\Facades\Session;

class MenuComponent extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $selectedItem = null; // Tracks the item to show in the modal

    public function mount()
    {
        $this->categories = Category::where('is_display', true)
            ->orderBy('sorting')
            ->get();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function showItemDetails($itemId)
    {
        $this->selectedItem = Item::find($itemId); // Fetch the item by ID
    }

    public function closeModal()
    {
        $this->selectedItem = null; // Clear the selected item to close the modal
    }

    public function addToCart($itemId){

        $addToCart_item = Item::findOrFail($itemId);
        $cart = Session::get('cart', []); // Get existing cart or empty array

        // Check if the item already exists in the cart
        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity']++; // Increment quantity
        } else {
            $cart[$itemId] = [ // Add new item
                'name' => $addToCart_item->name,
                'price' => $addToCart_item->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart); // Save updated cart

    }

    public function render()
    {
        $items = Item::where('is_display', true)
            ->when($this->selectedCategory, function ($query) {
                return $query->where('category_id', $this->selectedCategory);
            })
            ->orderBy('sorting')
            ->get();

        return view('livewire.menu-component', [
            'items' => $items
        ]);
    }
}
