<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Storage;


class ItemImageCrud extends Component
{
    use WithFileUploads;

    public $itemImages, $items, $item_id, $images = [], $captions = [], $sorting = 0, $image_id;
    public $editMode = false;

    protected $rules = [
        'item_id' => 'required|exists:items,id',
        'images.*' => 'required|image|max:2048', // Max 2MB per image
        'captions.*' => 'nullable|string|max:255',
        'sorting' => 'nullable|integer',
    ];

    public function mount()
    {
        $this->itemImages = ItemImage::with('item')->get();
        $this->items = Item::all(); // For the dropdown
    }

    public function render()
    {
        return view('livewire.item-image-crud')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate();

        if (!empty($this->images)) {
            foreach ($this->images as $index => $image) {
                $path = $image->store('item_images', 'public');
                ItemImage::create([
                    'item_id' => $this->item_id,
                    'image_path' => $path,
                    'caption' => $this->captions[$index] ?? null,
                    'sorting' => $this->sorting + $index,
                ]);
            }
        }

        $this->resetInputFields();
        $this->itemImages = ItemImage::with('item')->get();
        session()->flash('message', 'Images created successfully.');
    }

    public function edit($id)
    {
        $image = ItemImage::findOrFail($id);
        $this->image_id = $id;
        $this->item_id = $image->item_id;
        $this->captions = [$image->caption]; // Single image edit
        $this->sorting = $image->sorting;
        $this->images = []; // Reset for new uploads
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $image = ItemImage::find($this->image_id);

        if (!empty($this->images)) {
            // Delete old image if a new one is uploaded
            Storage::disk('public')->delete($image->image_path);
            $path = $this->images[0]->store('item_images', 'public');
            $image->update([
                'item_id' => $this->item_id,
                'image_path' => $path,
                'caption' => $this->captions[0] ?? null,
                'sorting' => $this->sorting,
            ]);
        } else {
            // Update without changing the image
            $image->update([
                'item_id' => $this->item_id,
                'caption' => $this->captions[0] ?? null,
                'sorting' => $this->sorting,
            ]);
        }

        $this->resetInputFields();
        $this->itemImages = ItemImage::with('item')->get();
        $this->editMode = false;
        session()->flash('message', 'Image updated successfully.');
    }

    public function delete($id)
    {
        $image = ItemImage::find($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        $this->itemImages = ItemImage::with('item')->get();
        session()->flash('message', 'Image deleted successfully.');
    }

    private function resetInputFields()
    {
        $this->item_id = '';
        $this->images = [];
        $this->captions = [];
        $this->sorting = 0;
        $this->image_id = null;
    }
}
