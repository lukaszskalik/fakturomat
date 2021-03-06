<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/faktury', [InvoicesController::class, 'index'])->name('invoices.index');

Route::get('/faktury/nowa', [InvoicesController::class, 'create'])->name('invoices.create');

Route::get('/faktury/edytuj/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');

Route::put('/faktury/aktualizuj/{id}', [InvoicesController::class, 'update'])->name('invoices.update');

Route::delete('/faktury/usun/{id}', [InvoicesController::class, 'delete'])->name('invoices.delete');

Route::post('/faktury/zapisz', [InvoicesController::class, 'store'])->name('invoices.store');

Route::resource('klienci', CustomerController::class, ['names' => 'customers']);

