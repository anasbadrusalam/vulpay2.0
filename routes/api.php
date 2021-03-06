<?php

use App\Http\Controllers\User\TransactionController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/otobot', function () {
//     return response()->json(['success' => true, 'message' => 'webhook landed perfectly :)']);
// });

Route::webhooks('otobot');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('transactions', TransactionController::class);

    // Route::apiResources([
    //     'transactions' => TransactionController::class,
    // ]);

});
