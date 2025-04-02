<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Create New Item
    </button>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($items as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="h-40 object-cover rounded">
                        @else
                            <span class="text-gray-500">No image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button wire:click="edit({{ $item->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2">
                            Edit
                        </button>
                        <button wire:click="delete({{ $item->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($isOpen)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" wire:click.self="closeModal()">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $item_id ? 'Edit Item' : 'Create Item' }}
                    </h3>
                    <div class="mt-2 px-7 py-3">
                        <form>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="category_id">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="name">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="description"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="price">
                                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Discount Price</label>
                                <input type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="discount_price">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Time to Cook (minutes)</label>
                                <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="time_for_cook">
                                @error('time_for_cook') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Sorting</label>
                                <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="sorting">
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" wire:model="is_display">
                                <label class="ml-2 block text-sm text-gray-900">Is Display</label>
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" wire:model="is_featured">
                                <label class="ml-2 block text-sm text-gray-900">Is Featured</label>
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" wire:model="is_veg">
                                <label class="ml-2 block text-sm text-gray-900">Is Vegetarian</label>
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" wire:model="is_spicy">
                                <label class="ml-2 block text-sm text-gray-900">Is Spicy</label>
                            </div>
                            <div class="mb-4">

                                @if($existingImage && !$image)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($existingImage) }}" class="max-w-24 h-auto object-contain">
                                        <p>Current Image</p>
                                    </div>
                                @endif

                                <label class="block text-sm font-medium text-gray-700">Image</label>
                                <input type="file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" wire:model="image">
                                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-end space-x-2 p-4">
                        <button wire:click="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Close
                        </button>
                        <button wire:click="store()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
