@props(['phone' => '', 'country' => '+91'])

<div class="flex gap-2">
    <div class="w-24">
        <input type="text"
               name="country_code"
               value="{{ $country }}"
               class="w-full border p-2 rounded focus:outline-none focus:ring focus:border-blue-300" />
    </div>
    <div class="flex-1">
        <input type="text"
               name="phone"
               value="{{ $phone }}"
               placeholder="Phone number"
               class="w-full border p-2 rounded focus:outline-none focus:ring focus:border-blue-300 @error('phone') border-red-500 @enderror" />
        @error('phone')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
