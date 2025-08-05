@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Customer Exports</h1>

    <form action="{{ route('customer-exports.store') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Start New Export
        </button>
    </form>


    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Queue</th>
                <th class="border px-4 py-2">Started On</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Download</th>
                <th class="border px-4 py-2">Error</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exports as $export)
                <tr>
                    <td class="border px-4 py-2">{{ $export->id }}</td>
                    <td class="border px-4 py-2">{{ $export->queue }}</td>
                    <td class="border px-4 py-2">{{ $export->started_at ?? '—' }}</td>
                    <td class="border px-4 py-2">
                        @if ($export->status === 'finished')
                            <span class="text-green-600 font-bold">Finished</span>
                        @elseif ($export->status === 'running')
                            <span class="text-blue-600">Running</span>
                        @elseif ($export->status === 'failed')
                            <span class="text-red-600">Failed</span>
                        @else
                            <span class="text-gray-600">Pending</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if ($export->status === 'finished')
                            <a href="{{ route('customer-exports.download', $export->id) }}"
                               class="text-blue-500 underline">Download</a>
                        @else
                            —
                        @endif
                    </td>
                    <td class="border px-4 py-2 text-red-600">
                        {{ $export->error ?? '—' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $exports->links() }}
    </div>
</div>
@endsection
