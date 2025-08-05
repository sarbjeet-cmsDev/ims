@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Customer Address</h1>

    <form action="{{ route('customer-addresses.update', ['customer_address' => $address->id]) }}" method="POST" id="edit-customer-addresses-form">
        
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Customer</label>
                <select name="customer_id" class="w-full border p-2 rounded">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id', $address->customer_id) == $customer->id ? 'selected' : '' }}>
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
                <select name="address_type" class="w-full border p-2 rounded">
                    @foreach (['Billing', 'Shipping', 'Office', 'Home'] as $type)
                        <option value="{{ $type }}" {{ old('address_type', $address->address_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('address_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <x-address :address="$address" />

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block font-semibold mb-1">Apartment</label>
                <input type="text" name="apartment" value="{{ old('apartment', $address->apartment) }}" class="w-full border p-2 rounded">
                @error('apartment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">State</label>
                <input type="text" name="state" value="{{ old('state', $address->state) }}" class="w-full border p-2 rounded">
                @error('state')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $address->latitude) }}" class="w-full border p-2 rounded">
                @error('latitude')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $address->longitude) }}" class="w-full border p-2 rounded">
                @error('longitude')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $address->phone) }}" class="w-full border p-2 rounded">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Default Address</label>
                <select name="is_default" class="w-full border p-2 rounded">
                    <option value="0" {{ old('is_default', $address->is_default) == false ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_default', $address->is_default) == true ? 'selected' : '' }}>Yes</option>
                </select>
                @error('is_default')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Notes</label>
                <textarea name="notes" class="w-full border p-2 rounded" rows="3">{{ old('notes', $address->notes) }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Address
            </button>
        </div>
    </form>
</div>
@endsection
