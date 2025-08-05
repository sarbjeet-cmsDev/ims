@props(['address'])

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
    <div>
        <label class="block font-semibold mb-1">Street Address</label>
        <input type="text" name="street_address" value="{{ old('street_address', $address?->street_address) }}" class="w-full border p-2 rounded">
        @error('street_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">City</label>
        <input type="text" name="city" value="{{ old('city', $address?->city) }}" class="w-full border p-2 rounded">
        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Country</label>
        <input type="text" name="country" value="{{ old('country', $address?->country) }}" class="w-full border p-2 rounded">
        @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block font-semibold mb-1">Postal Code</label>
        <input type="text" name="postal_code" value="{{ old('postal_code', $address?->postal_code) }}" class="w-full border p-2 rounded">
        @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div>
