@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Customer Import</h1>

    <form action="{{ url('/customer/import') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <label class="block mb-2">Select CSV file to import:</label>
        <input type="file" name="csv_file" accept=".csv" required class="border px-3 py-2 mb-2 w-full">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Import Jobs Table --}}
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Queue</th>
                <th class="border px-4 py-2">Start On</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Download Report</th>
            </tr>
        </thead>
        <tbody>
            @foreach($imports as $import)
                <tr>
                    <td class="border px-4 py-2">{{ $import->id }}</td>
                    <td class="border px-4 py-2">customer-import</td>
                    <td class="border px-4 py-2">{{ $import->started_at ?? '—' }}</td>
                    <td class="border px-4 py-2">
                        @if ($import->status === 'Finished')
                            <span class="text-green-600 font-bold">Finished</span>
                        @elseif ($import->status === 'Failed')
                            <span class="text-red-600">Failed</span>
                        @else
                            <span class="text-gray-600">Pending</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if(in_array($import->status, ['Finished', 'Failed']))
                            <a href="{{ url('/customer/import/report/' . $import->id) }}" class="text-blue-500 underline">
                                {{ $import->status === 'Finished' ? 'Download' : 'View Error' }}
                            </a>
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
