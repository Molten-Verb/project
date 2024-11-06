<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OwnRacersController;
use App\Http\Controllers\MarketRacerController;

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

Route::middleware('auth')->prefix('profile')
    ->name('profile.')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::post('/', 'store')->name('image.update');
        Route::delete('/', 'destroy')->name('destroy');
});

Route::get('/auth/redirect', [SocialController::class, 'redirectToGoogle'])
    ->name('google.auth');

Route::get('/auth/callback', [SocialController::class, 'googleCallback'])
    ->name('google.callback');

require __DIR__.'/auth.php';

Route::prefix('currency')
    ->controller(CurrencyController::class)
    ->group( function () {
        Route::get('/', 'index')
            ->name('currency.index');
        Route::post('/', 'exchangeCurrency')
            ->name('exchangeCurrency.post');
});

Route::middleware('auth')->prefix('wallet/{id}')
    ->name('wallet.')
    ->controller(WalletController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/transaction_history', 'show')->name('history');
        Route::patch('/', 'update')->name('update');
        Route::post('/', 'store')->name('store');
});

Route::prefix('market')
    ->name('market.')
    ->controller(MarketRacerController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::middleware('auth')->post('/buy/{racer}', 'buy')->name('buy');
        Route::post('/sell/{racer}', 'sell')->name('sell');
});

Route::middleware('auth')->prefix('ownRacers')
    ->name('ownRacers.')
    ->controller(OwnRacersController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/sell/{racer}/half-price', 'sellHalfPrice')->name('sell.half-price');
        Route::patch('/update/{racer}', 'update')->name('update');
});

Route::prefix('users')
    ->name('users.')
    ->controller(UsersController::class)
    ->group( function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });
