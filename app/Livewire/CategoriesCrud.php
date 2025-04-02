<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;  //delete()
use Illuminate\Support\Str;

class CategoriesCrud extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $description, $sorting, $image, $slug, $is_display = true;
    public $categoryId = null;
    public $search = '';
    public $showModal = false;
    public $existingImage = null; // to store the current image path when edit

    protected $rules = [
        'name' => 'required|min:2',
        'description' => 'nullable',
        'sorting' => 'required|integer',
        'image' => 'nullable|image|max:1024',
        'slug' => 'required|unique:categories,slug',
        'is_display' => 'boolean'
    ];

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('sorting')
            ->paginate(10);

        return view('livewire.categories-crud-v2', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {

        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->sorting = $category->sorting;
        $this->slug = $category->slug;
        $this->is_display = $category->is_display;
        $this->existingImage = $category->image; // Store the current image path
        $this->image = null; // Reset the image upload field
        $this->showModal = true;

    }

    public function save()
    {

        $rules = $this->rules;

        // user can use the same slug when edit
        if ($this->categoryId) {
            // unique check exclude the current record's ID
            $rules['slug'] = 'required|unique:categories,slug,' . $this->categoryId;
        } else {
            // unique check
            $rules['slug'] = 'required|unique:categories,slug';
        }

        // Validate the data
        $data = $this->validate($rules);

        // Handle image upload
        if ($this->image) {
            // If a new image is uploaded, store it and delete the old one if it exists
            if ($this->categoryId && $this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['image'] = $this->image->store('categories', 'public');
        } elseif ($this->categoryId) {
            // If no new image is uploaded, keep the existing image
            $data['image'] = $this->existingImage;
        }

        if ($this->categoryId) {
            // Update existing record
            $category = Category::find($this->categoryId);
            $category->update($data);
        } else {
            // Create new record
            Category::create($data);
        }

        $this->showModal = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        //Category::find($id)->delete();

        //Delete Image as well
        $category = Category::find($id);
        if ($category) {
            // Delete the image file from storage if it exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            // Delete the category record from the database
            $category->delete();
        }

    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    private function resetFields()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->description = '';
        $this->sorting = 0;
        $this->image = null;
        $this->slug = '';
        $this->is_display = true;
        $this->existingImage = null; // Reset the existing image
    }
}
