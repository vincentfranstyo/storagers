<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Login;


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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//    Route::post('/register', [AuthController::class, 'register'])->name('register');
//    Route::post('/login', [AuthController::class, 'login'])->name('login');
//});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'jwt.verify'], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/user-profile', [AuthController::class, 'me'])->name('user-profile');
    });
});


//Route::group(['middleware' => 'api'], function ($router) {
//    Route::get('/', [HomeController::class, 'index'])->name('home');
//    Route::get('/detail/{name}', [DetailController::class, 'show'])->name('detail');
//    Route::get('/history', [HistoryController::class, 'index'])->name('history');
//    Route::get('/purchase/{name}', [PurchaseController::class, 'show'])->name('purchase.show');
//    Route::post('/purchase/{name}', [PurchaseController::class, 'purchase'])->name('purchase');
//});
