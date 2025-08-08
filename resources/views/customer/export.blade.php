@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Customer Export</h1>

    <form method="POST" action="{{ url('/customer/export') }}" class="mb-6">
        @csrf
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Start Export
        </button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Queue</th>
                <th class="border px-4 py-2">Start On</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Download File</th>
                <th class="border px-4 py-2">Error Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td class="border px-4 py-2">{{ $job->id }}</td>
                    <td class="border px-4 py-2">{{ $job->queue }}</td>
                    <td class="border px-4 py-2">{{ $job->started_at ?? '—' }}</td>
                    <td class="border px-4 py-2">
                        @if ($job->status === 'finished')
                            <span class="text-green-600 font-bold">Finished</span>
                        @elseif ($job->status === 'failed')
                            <span class="text-red-600">Failed</span>
                        @else
                            <span class="text-gray-600">Pending</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if($job->status === 'finished')
                            <a href="{{ url('/customer/export/download/' . $job->id) }}" class="text-blue-500 underline">
                                Download
                            </a>
                        @else
                            —
                        @endif
                    </td>
                    <td class="border px-4 py-2 text-sm text-red-700">
                        {{ $job->error_message ?? '—' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
