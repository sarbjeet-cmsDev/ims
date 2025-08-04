@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="w-full border p-2 rounded">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="w-full border p-2 rounded">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full border p-2 rounded">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name', $customer->company_name) }}" class="w-full border p-2 rounded">
                @error('company_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Contact Person</label>
                <input type="text" name="contact_person" value="{{ old('contact_person', $customer->contact_person) }}" class="w-full border p-2 rounded">
                @error('contact_person')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Customer Type</label>
                <select name="customer_type" class="w-full border p-2 rounded">
                    @foreach (['Individual', 'Business', 'Reseller'] as $type)
                        <option value="{{ $type }}" {{ old('customer_type', $customer->customer_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('customer_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Tax ID</label>
                <input type="text" name="tax_id" value="{{ old('tax_id', $customer->tax_id) }}" class="w-full border p-2 rounded">
                @error('tax_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border p-2 rounded">
                    @foreach (['Active', 'Inactive', 'Prospective'] as $status)
                        <option value="{{ $status }}" {{ old('status', $customer->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Credit Limit</label>
                <input type="number" step="0.01" name="credit_limit" value="{{ old('credit_limit', $customer->credit_limit) }}" class="w-full border p-2 rounded">
                @error('credit_limit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Total Purchases</label>
                <input type="number" step="0.01" name="total_purchases" value="{{ old('total_purchases', $customer->total_purchases) }}" class="w-full border p-2 rounded">
                @error('total_purchases')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Last Purchase At</label>
                <input type="datetime-local" name="last_purchase_at" value="{{ old('last_purchase_at', $customer->last_purchase_at ? $customer->last_purchase_at->format('Y-m-d\TH:i') : '') }}" class="w-full border p-2 rounded">
                @error('last_purchase_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Registered At</label>
                <input type="datetime-local" name="registered_at" value="{{ old('registered_at', $customer->registered_at ? $customer->registered_at->format('Y-m-d\TH:i') : '') }}" class="w-full border p-2 rounded">
                @error('registered_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Notes</label>
                <textarea name="notes" class="w-full border p-2 rounded" rows="3">{{ old('notes', $customer->notes) }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Customer
            </button>
        </div>
    </form>
</div>
@endsection
