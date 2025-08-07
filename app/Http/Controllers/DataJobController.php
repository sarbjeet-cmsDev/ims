<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataJob;
use App\Jobs\ExportCustomersJob;
use App\Jobs\ImportCustomersJob;
use Illuminate\Support\Facades\Storage;

class DataJobController extends Controller
{
    public function exportIndex()
    {
        $jobs = DataJob::where('type', 'export')->latest()->get();
        return view('customer.export', compact('jobs'));
    }

    public function exportStore()
    {
        $job = DataJob::create([
            'type' => 'export',
            'queue' => 'customer-export',
            'status' => 'pending',
        ]);

        ExportCustomersJob::dispatch($job->id)->onQueue('customer-export');

        return redirect()->back()->with('success', 'Export job started!');
    }

    public function importIndex()
    {
        $jobs = DataJob::where('type', 'import')->latest()->get();
        return view('customer.import', compact('jobs'));
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $path = $file->storeAs('imports', uniqid() . '_' . $file->getClientOriginalName());

        $job = DataJob::create([
            'type' => 'import',
            'queue' => 'customer-import',
            'status' => 'pending',
            'file_path' => $path,
        ]);

        ImportCustomersJob::dispatch($job->id)->onQueue('customer-import');

        return redirect()->back()->with('success', 'Import job started!');
    }

    public function download($id)
    {
        $job = DataJob::findOrFail($id);
        if (!Storage::exists($job->file_path)) abort(404);
        return Storage::download($job->file_path);
    }
    
    public function downloadReport($id)
    {
        $job = DataJob::findOrFail($id);

        if (!$job->report_path || !Storage::exists($job->report_path)) {
            abort(404, 'Report not found.');
        }

        return Storage::download($job->report_path, 'customer_import_report_' . $job->id . '.log');
    }

}

