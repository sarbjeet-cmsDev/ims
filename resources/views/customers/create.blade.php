@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Create New Customer</h1>


    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border p-2 rounded @error('name') border-red-500 @enderror">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded @error('email') border-red-500 @enderror">
                @error('email')
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
                <label class="block font-semibold mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" class="w-full border p-2 rounded @error('company_name') border-red-500 @enderror">
                 @error('company_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Contact Person</label>
                <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="w-full border p-2 rounded @error('contact_person') border-red-500 @enderror">
                 @error('contact_person')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Customer Type</label>
                <select name="customer_type" class="w-full border p-2 rounded @error('customer_type') border-red-500 @enderror">
                    <option value="">-- Select Type --</option>
                    <option value="Individual" {{ old('customer_type') == 'Individual' ? 'selected' : '' }}>Individual</option>
                    <option value="Business" {{ old('customer_type') == 'Business' ? 'selected' : '' }}>Business</option>
                    <option value="Reseller" {{ old('customer_type') == 'Reseller' ? 'selected' : '' }}>Reseller</option>
                </select>
                @error('customer_type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Tax ID</label>
                <input type="text" name="tax_id" value="{{ old('tax_id') }}" class="w-full border p-2 rounded @error('tax_id') border-red-500 @enderror">
                 @error('tax_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border p-2 rounded @error('status') border-red-500 @enderror">
                    <option value="">-- Select Status --</option>
                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="Prospective" {{ old('status') == 'Prospective' ? 'selected' : '' }}>Prospective</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Credit Limit</label>
                <input type="number" step="0.01" name="credit_limit" value="{{ old('credit_limit') }}" class="w-full border p-2 rounded @error('credit_limit') border-red-500 @enderror">
                @error('credit_limit')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Total Purchases</label>
                <input type="number" step="0.01" name="total_purchases" value="{{ old('total_purchases') }}" class="w-full border p-2 rounded @error('total_purchases') border-red-500 @enderror">
                @error('total_purchases')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Last Purchase At</label>
                <input type="datetime-local" name="last_purchase_at" value="{{ old('last_purchase_at') }}" class="w-full border p-2 rounded @error('last_purchase_at') border-red-500 @enderror">
                @error('last_purchase_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1">Registered At</label>
                <input type="datetime-local" name="registered_at" value="{{ old('registered_at') }}" class="w-full border p-2 rounded @error('registered_at') border-red-500 @enderror">
                @error('registered_at')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block font-semibold mb-1">Notes</label>
                <textarea name="notes" class="w-full border p-2 rounded @error('notes') border-red-500 @enderror" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Customer
            </button>
        </div>
    </form>
</div>
@endsection
