<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Str;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $sorting = 0;
    public $image;
    public $is_display = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'sorting' => 'integer|min:0',
        'image' => 'nullable|image|max:2048', // Max 2MB
        'is_display' => 'boolean',
    ];

    public function submit()
    {
        $this->validate();

        // Handle image upload if provided
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
        }

        // Create the category
        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'sorting' => $this->sorting,
            'image' => $imagePath,
            'is_display' => $this->is_display,
        ]);

        //'slug' => Str::slug($this->name), // Slug auto-generated , do it in model

        // Reset form fields
        $this->reset();

        session()->flash('message', 'Category created successfully!');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
