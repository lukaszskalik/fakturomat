<?php

use App\Http\Controllers\Api\CustomersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/klienci', [CustomersController::class, 'index']);
Route::middleware('auth:sanctum')->get('/klienci/{customer}', [CustomersController::class, 'show']);
Route::middleware('auth:sanctum')->post('/klienci/zapisz', [CustomersController::class, 'store']);
Route::middleware('auth:sanctum')->put('/klienci/aktualizuj/{id}', [CustomersController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/klienci/{customer}', [CustomersController::class, 'destroy']);

