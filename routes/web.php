<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');
    Route::post('/', 'store')->name('avatar.update');
    Route::delete('/', 'destroy')->name('destroy');
});

Route::get('/auth/redirect', [SocialController::class, 'redirectToGoogle'])
    ->name('google.auth');
Route::get('/auth/callback', [SocialController::class, 'googleCallback'])
    ->name('google.callback');

require __DIR__.'/auth.php';

Route::get('/currency', [CurrencyController::class, 'index'])
    ->name('currency');
Route::post('/currency', [CurrencyController::class, 'exchangeCurrency'])
    ->name('exchangeCurrency');

Route::middleware('auth')->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.home');
    Route::patch('/wallet', [WalletController::class, 'update'])->name('wallet.update');
    Route::post('/wallet', [WalletController::class, 'store'])->name('wallet.create');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
