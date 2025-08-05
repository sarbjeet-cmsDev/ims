@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Customer Addresses</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('customer-addresses.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Add New Address
        </a>
    </div>

    @if ($addresses->isEmpty())
        <p class="text-gray-500">No customer addresses found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-2 border-b">Customer</th>
                        <th class="text-left p-2 border-b">Type</th>
                        <th class="text-left p-2 border-b">Street</th>
                        <th class="text-left p-2 border-b">City</th>
                        <th class="text-left p-2 border-b">State</th>
                        <th class="text-left p-2 border-b">Postal</th>
                        <th class="text-left p-2 border-b">Country</th>
                        <th class="text-left p-2 border-b">Default</th>
                        <th class="text-left p-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2">{{ $address->customer->name ?? 'N/A' }}</td>
                            <td class="p-2">{{ $address->address_type }}</td>
                            <td class="p-2">{{ $address->street_address }}</td>
                            <td class="p-2">{{ $address->city }}</td>
                            <td class="p-2">{{ $address->state }}</td>
                            <td class="p-2">{{ $address->postal_code }}</td>
                            <td class="p-2">{{ $address->country }}</td>
                            <td class="p-2">
                                @if ($address->is_default)
                                    <span class="text-green-600 font-semibold">Yes</span>
                                @else
                                    <span class="text-gray-500">No</span>
                                @endif
                            </td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('customer-addresses.edit', $address->id) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('customer-addresses.destroy', $address->id) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $addresses->links() }}
        </div>
    @endif
</div>
@endsection
