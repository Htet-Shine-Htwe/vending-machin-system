<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('home');

Route::prefix('')
    ->group(function ()
    {
        \App\Services\Route\RouteHelper::includedRouteFiles(__DIR__ . '/portal');
        \App\Services\Route\RouteHelper::includedRouteFiles(__DIR__ . '/user');
    });

require __DIR__.'/auth.php';
