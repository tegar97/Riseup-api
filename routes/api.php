<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\TransactionController;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [
        'prefix' => 'v1'
    ],
    function () {
        Route::get('/categories' , [CategoryController::class, 'apiCategory']);
        Route::get('/funding', [FundingController::class, 'apiIndex']);
        Route::get('/funding/{id}', [FundingController::class, 'apiIndexDetail']);

        Route::post('/transaction', [TransactionController::class, 'Fund']);
        Route::post('/webhook', [TransactionController::class, 'webHookHandler']);
        Route::get('/transaction', [TransactionController::class, 'getMyTransaction']);
        Route::group([
            'prefix' => 'auth'
        ], function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('me', [AuthController::class, 'me']);







        });

    }
);

