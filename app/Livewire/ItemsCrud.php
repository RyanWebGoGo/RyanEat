<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;  //delete()

class ItemsCrud extends Component
{
    use WithFileUploads;

    public $items, $categories, $category_id, $name, $description, $price, $discount_price,
        $time_for_cook, $sorting, $is_display = true, $is_featured = false,
        $is_veg = false, $is_spicy = false, $image, $item_id;

    public $isOpen = false;

    public $existingImage = null; // to store the current image path when edit

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        $this->items = Item::with('category')->get();
        return view('livewire.items-crud');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->category_id = '';
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->discount_price = '';
        $this->time_for_cook = '';
        $this->sorting = '';
        $this->is_display = true;
        $this->is_featured = false;
        $this->is_veg = false;
        $this->is_spicy = false;
        $this->image = null;
        $this->item_id = null;
        $this->existingImage = null; // Reset the existing image
    }

    public function store()
    {
        $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'time_for_cook' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'time_for_cook' => $this->time_for_cook,
            'sorting' => $this->sorting ?? 0,
            'is_display' => $this->is_display,
            'is_featured' => $this->is_featured,
            'is_veg' => $this->is_veg,
            'is_spicy' => $this->is_spicy,
        ];

        /*
        if ($this->image) {
            $data['image'] = $this->image->store('items', 'public');
        }*/

        // Handle image upload
        if ($this->image) {
            // If a new image is uploaded, store it and delete the old one if it exists
            if ($this->item_id && $this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image'] = $this->image->store('items', 'public');
        } elseif ($this->item_id) {
            // If no new image is uploaded, keep the existing image
            $data['image'] = $this->existingImage;
        }

        Item::updateOrCreate(['id' => $this->item_id], $data);

        session()->flash('message',
            $this->item_id ? 'Item updated successfully.' : 'Item created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->item_id = $id;
        $this->category_id = $item->category_id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->price = $item->price;
        $this->discount_price = $item->discount_price;
        $this->time_for_cook = $item->time_for_cook;
        $this->sorting = $item->sorting;
        $this->is_display = $item->is_display;
        $this->is_featured = $item->is_featured;
        $this->is_veg = $item->is_veg;
        $this->is_spicy = $item->is_spicy;

        $this->existingImage = $item->image; // Store the current image path
        $this->image = null; // Reset the image upload field

        $this->openModal();
    }

    public function delete($id)
    {
        //Item::find($id)->delete();

        $item = Item::find($id);
        if ($item) {
            // Delete the image file from storage if it exists
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            // Delete the category record from the database
            $item->delete();
        }

        session()->flash('message', 'Item deleted successfully.');
    }
}
