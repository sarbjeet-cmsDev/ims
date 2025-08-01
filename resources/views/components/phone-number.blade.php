<div class="mb-4">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="flex space-x-2">
        <input type="text" id="{{ $id }}_country" name="{{ $id }}_country" class="w-1/4 p-2 border border-gray-300 rounded-md" placeholder="+1">
        <input type="text" id="{{ $id }}" name="{{ $id }}" class="w-3/4 p-2 border border-gray-300 rounded-md" placeholder="Phone Number">
    </div>
</div>
