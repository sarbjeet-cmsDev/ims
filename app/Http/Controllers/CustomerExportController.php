<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerExport;
use App\Jobs\ExportCustomersJob;
use Illuminate\Support\Facades\Storage;

class CustomerExportController extends Controller
{
    public function index()
    {
        $exports = CustomerExport::latest()->paginate(10);
        return view('customer_exports.index', compact('exports'));
    }

    public function download($id)
    {
        $export = CustomerExport::findOrFail($id);

        if ($export->status !== 'finished' || !Storage::exists($export->file_path)) {
            return back()->with('error', 'File not ready or not found.');
        }

        return Storage::download($export->file_path);
    }

    public function store(Request $request)
    {
        $export = CustomerExport::create([
            'status' => 'pending',
            'queue' => 'customer-export',
        ]);

        ExportCustomersJob::dispatch($export)->onQueue('customer-export');
        return redirect()->route('customer-exports.index')->with('success', 'Customer export started!');
    }
}
