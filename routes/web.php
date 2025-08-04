<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAddressController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/components-demo', fn() => view('components-demo'));

Route::resource('customers', CustomerController::class);
Route::resource('customer-addresses', CustomerAddressController::class);

