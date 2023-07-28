<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HistoryController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;

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
    return redirect('/login');
});

Route::middleware('jwt.verify')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/detail/{name}', [DetailController::class, 'show'])->name('detail');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/purchase/{name}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{name}', [PurchaseController::class, 'purchase'])->name('purchase');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login_page');

    Route::get('register', Register::class)
        ->name('register_page');
});


