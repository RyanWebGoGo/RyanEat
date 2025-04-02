<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="{{ $editMode ? 'update' : 'store' }}" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="item_id" class="block text-sm font-medium text-gray-700">Item</label>
            <select
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                wire:model="item_id"
                id="item_id"
            >
                <option value="">Select an Item</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('item_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="images" class="block text-sm font-medium text-gray-700">Upload Images</label>
            <input
                type="file"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                wire:model="images"
                multiple
                {{ $editMode ? '' : 'required' }}
            >
            @error('images.*')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if (!empty($images))
            @foreach ($images as $index => $image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Caption for Image {{ $index + 1 }}</label>
                    <input
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        wire:model="captions.{{ $index }}"
                    >
                </div>
            @endforeach
        @endif

        <div class="mb-4">
            <label for="sorting" class="block text-sm font-medium text-gray-700">Sorting</label>
            <input
                type="number"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                wire:model="sorting"
                id="sorting"
            >
            @error('sorting')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex space-x-2">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                {{ $editMode ? 'Update' : 'Create' }}
            </button>
            @if ($editMode)
                <button
                    type="button"
                    wire:click="create"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                >
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <!-- Item Images List -->
    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Caption</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sorting</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($itemImages as $image)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $image->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $image->item->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ Storage::url($image->image_path) }}" alt="{{ $image->caption }}" class="max-w-[100px] h-auto">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $image->caption }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $image->sorting }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        {{--
                        <button
                            wire:click="edit({{ $image->id }})"
                            class="text-yellow-600 hover:text-yellow-900 mr-2"
                        >
                            Edit
                            --}}
                        </button>
                        <button
                            wire:click="delete({{ $image->id }})"
                            class="text-red-600 hover:text-red-900"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        No images found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
