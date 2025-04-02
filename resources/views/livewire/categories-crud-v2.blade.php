<!-- resources/views/livewire/categories-crud.blade.php -->
<div>
    <div class="mb-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Search categories..."
            class="border p-2 rounded"
        >
        <button
            wire:click="create"
            class="bg-blue-500 text-white p-2 rounded ml-2"
        >
            Add Category
        </button>
    </div>

    <!-- Categories Table -->
    <table class="w-full border text-center">
        <thead>
        <tr class="bg-gray-200">
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Description</th>
            <th class="p-2">Sorting</th>
            <th class="p-2">Image</th>
            <th class="p-2">Slug</th>
            <th class="p-2">Display</th>
            <th class="p-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="p-2">{{ $category->id }}</td>
                <td class="p-2">{{ $category->name }}</td>
                <td class="p-2">{{ $category->description }}</td>
                <td class="p-2">{{ $category->sorting }}</td>
                <td class="p-2">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" class="max-w-24 h-auto object-contain mx-auto block">
                    @endif
                </td>
                <td class="p-2">{{ $category->slug }}</td>
                <td class="p-2">{{ $category->is_display ? 'Yes' : 'No' }}</td>
                <td class="p-2">
                    <button wire:click="edit({{ $category->id }})" class="bg-green-500 text-white p-1 rounded">
                        Edit
                    </button>
                    <button wire:click="delete({{ $category->id }})" class="bg-red-500 text-white p-1 rounded ml-2">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded w-1/2">
                <h2 class="text-xl mb-4">
                    {{ $categoryId ? 'Edit Category' : 'Add Category' }}
                </h2>

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <input
                            type="text"
                            wire:model="name"
                            placeholder="Name"
                            class="w-full p-2 border rounded"
                        >
                        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <textarea
                            wire:model="description"
                            placeholder="Description"
                            class="w-full p-2 border rounded"
                        ></textarea>
                    </div>

                    <div class="mb-4">
                        <input
                            type="number"
                            wire:model="sorting"
                            placeholder="Sorting"
                            class="w-full p-2 border rounded"
                        >
                        @error('sorting') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>Image</label>
                        @if($existingImage && !$image)
                            <div class="mb-2">
                                <img src="{{ Storage::url($existingImage) }}" class="max-w-24 h-auto object-contain">
                                <p>Current Image</p>
                            </div>
                        @endif
                        <input
                            type="file"
                            wire:model="image"
                            class="w-full p-2 border rounded"
                        >
                        @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <input
                            type="text"
                            wire:model="slug"
                            placeholder="Slug"
                            class="w-full p-2 border rounded"
                        >
                        <button
                            type="button"
                            wire:click="generateSlug"
                            class="mt-2 bg-gray-500 text-white p-1 rounded"
                        >
                            Generate Slug
                        </button>
                        @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label>
                            <input type="checkbox" wire:model="is_display">
                            Display Category
                        </label>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="bg-blue-500 text-white p-2 rounded"
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            wire:click="$set('showModal', false)"
                            class="bg-gray-500 text-white p-2 rounded ml-2"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
