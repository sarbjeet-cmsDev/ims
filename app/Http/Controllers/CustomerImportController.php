<?php

namespace App\Http\Controllers;

use App\Models\CustomerImport;
use App\Jobs\ImportCustomersJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerImportController extends Controller
{
    public function index()
    {
        $imports = CustomerImport::latest()->get();
        return view('customer.import.index', compact('imports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $filename = uniqid() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('customer-import/reports', $filename, 'local');

        $import = CustomerImport::create([
            'file_path' => $path,
            'status' => 'pending',
        ]);

        ImportCustomersJob::dispatch($import->id)->onQueue('customer-import');

        return redirect()->back()->with('success', 'Customer import started.');
    }


    public function downloadReport($id)
    {
        $import = CustomerImport::findOrFail($id);

        if (!in_array($import->status, ['finished', 'failed']) || !$import->report_path) {
            abort(404);
        }

        return Storage::disk('local')->download($import->report_path);
    }
}
