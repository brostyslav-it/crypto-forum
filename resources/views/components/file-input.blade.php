<div class="mb-4">
    <label for="avatar" class="block text-gray-700">{{ $slot }}</label>

    <div class="flex items-center">
        <label for="image" class="cursor-pointer bg-gray-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">
            Choose File
        </label>
        <span id="file-name" class="ml-4 text-gray-500">No file chosen</span>
    </div>
    <input type="file" accept="image/png, image/gif, image/jpeg" name="image" id="image" class="hidden" onchange="updateFileName()">
    @error('image')
    <x-form-error>{{ $message }}</x-form-error>
    @enderror
</div>
