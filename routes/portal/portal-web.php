<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])
    ->prefix('portal')
    ->group(function ()
    {
        RouteRole('admin', function ()
        {
            Route::get('users', [UserController::class, 'index'])->name('users.index');
        });

        Route::controller(ProfileController::class)->group(function ()
            {
                Route::get('profile', 'edit')->name('profile.edit');
                Route::patch('profile', 'update')->name('profile.update');
                Route::delete('profile', 'destroy')->name('profile.destroy');
            });

        RouteRole('admin|officer',function(){
            Route::controller(ProductController::class)->group(function ()
            {
                Route::get('products', 'index')->name('products.index');
                Route::get('products/create', 'create')->name('products.create');
                Route::post('products/store', 'store')->name('products.store');
                Route::get('products/edit/{slug}', 'edit')->name('products.edit');
                Route::post('products/update/{slug}', 'update')->name('products.update');
                Route::delete('products/delete/{slug}', 'delete')->name('products.delete');
            });
        });

        RouteRole('user|admin|officer',function(){
            Route::controller(TransactionController::class)->group(function ()
            {
                Route::get('transactions', 'index')->name('transactions.index');
            });
        });
    });





