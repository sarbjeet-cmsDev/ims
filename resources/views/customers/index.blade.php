@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Customer List</h1>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($customers->isEmpty())
        <p class="text-gray-500">No customers found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full bg-white border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-2 border-b">Name</th>
                        <th class="text-left p-2 border-b">Email</th>
                        <th class="text-left p-2 border-b">Phone</th>
                        <th class="text-left p-2 border-b">Status</th>
                        <th class="text-left p-2 border-b">Type</th>
                        <th class="text-left p-2 border-b">Registered At</th>
                        <th class="text-left p-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2">{{ $customer->name }}</td>
                            <td class="p-2">{{ $customer->email }}</td>
                            <td class="p-2">{{ $customer->phone }}</td>
                            <td class="p-2">{{ $customer->status }}</td>
                            <td class="p-2">{{ $customer->customer_type }}</td>
                            <td class="p-2">
                                {{ $customer->registered_at ? \Carbon\Carbon::parse($customer->registered_at)->format('Y-m-d H:i') : 'N/A' }}
                            </td>
                            <td class="p-2">
                            <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:underline">Edit</a>

                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block ml-2"
                                onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
            {{ $customers->links() }}
        </div>
    @endif
</div>
@endsection
