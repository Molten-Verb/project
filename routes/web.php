<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SocialController;
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

Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/', [ProfileController::class, 'store'])->name('profile.avatar.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
