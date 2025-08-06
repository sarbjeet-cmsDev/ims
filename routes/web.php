<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAddressController;
use App\Jobs\ExportCustomersJob;
use App\Http\Controllers\CustomerExportController;
use App\Http\Controllers\CustomerImportController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/components-demo', fn() => view('components-demo'));

Route::resource('customers', CustomerController::class);
Route::resource('customer-addresses', CustomerAddressController::class);

Route::get('/export-customers', function () {
    ExportCustomersJob::dispatch()->onQueue('customer-export');
    return 'Export started!';
});
Route::get('/customer/export', [CustomerExportController::class, 'index'])->name('customer-exports.index');
Route::get('/customer/export/{id}/download', [CustomerExportController::class, 'download'])->name('customer-exports.download');
Route::post('/customer/export', [CustomerExportController::class, 'store'])->name('customer-exports.store');

Route::get('/customer/import', [CustomerImportController::class, 'index']);
Route::post('/customer/import', [CustomerImportController::class, 'store']);
Route::get('/customer/import/report/{id}', [CustomerImportController::class, 'downloadReport']);