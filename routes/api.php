<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Verify;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AuthController;


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


Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/register', [Register::class, 'register'])->name('registerApi');
    Route::post('/login', [Login::class, 'authenticate'])->name('loginApi');
    Route::post('logout', [LogoutController::class, '__invoke'])->name('logout');
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/detail/{name}', [DetailController::class, 'show'])->name('detail');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/purchase/{name}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{name}', [PurchaseController::class, 'purchase'])->name('purchase');
});


//Route::middleware(['auth:api'])->group(function () {
//    Route::get('/loginAuth', Login::class);
//    // Add all your routes here
//});


Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
});
