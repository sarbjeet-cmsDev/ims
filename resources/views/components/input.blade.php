
<input type="{{ $type ?? 'text' }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ old($name, $value ?? '') }}"
    class="form-input block w-full p-2.5 border rounded-lg border-gray-500 @error($name) border-red-500 @enderror"
    placeholder="{{ $placeholder ?? '' }}" />

@error($name)
    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
@enderror
