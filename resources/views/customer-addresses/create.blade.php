@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Add Customer Address</h1>

    <form action="{{ route('customer-addresses.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Customer</label>
                <select name="customer_id" class="w-full border p-2 rounded @error('customer_id') border-red-500 @enderror">
                    <option value="">-- Select Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Address Type</label>
                <select name="address_type" class="w-full border p-2 rounded @error('address_type') border-red-500 @enderror">
                    <option value="">-- Select Type --</option>
                    @foreach (['Billing', 'Shipping', 'Office', 'Home'] as $type)
                        <option value="{{ $type }}" {{ old('address_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('address_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Street Address</label>
                <input type="text" name="street_address" value="{{ old('street_address') }}" class="w-full border p-2 rounded @error('street_address') border-red-500 @enderror">
                @error('street_address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Apartment</label>
                <input type="text" name="apartment" value="{{ old('apartment') }}" class="w-full border p-2 rounded @error('apartment') border-red-500 @enderror">
                @error('apartment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">City</label>
                <input type="text" name="city" value="{{ old('city') }}" class="w-full border p-2 rounded @error('city') border-red-500 @enderror">
                @error('city')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">State</label>
                <input type="text" name="state" value="{{ old('state') }}" class="w-full border p-2 rounded @error('state') border-red-500 @enderror">
                @error('state')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Postal Code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full border p-2 rounded @error('postal_code') border-red-500 @enderror">
                @error('postal_code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Country</label>
                <input type="text" name="country" value="{{ old('country') }}" class="w-full border p-2 rounded @error('country') border-red-500 @enderror">
                @error('country')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude') }}" class="w-full border p-2 rounded @error('latitude') border-red-500 @enderror">
                @error('latitude')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude') }}" class="w-full border p-2 rounded @error('longitude') border-red-500 @enderror">
                @error('longitude')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border p-2 rounded @error('phone') border-red-500 @enderror">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Default Address</label>
                <select name="is_default" class="w-full border p-2 rounded @error('is_default') border-red-500 @enderror">
                    <option value="0" {{ old('is_default') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_default') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('is_default')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Notes</label>
                <textarea name="notes" rows="3" class="w-full border p-2 rounded @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Address
            </button>
        </div>
    </form>
</div>
@endsection
