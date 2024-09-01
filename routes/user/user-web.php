<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
->prefix('portal')
->group(function () {

    RouteRole('user|admin|officer',function(){
        Route::controller(PurchaseController::class)->group(function ()
        {
            Route::get('purchase', 'index')->name('purchase.index');
        });

        Route::controller(ProductController::class)->group(function ()
        {
            Route::post('purchase/create', 'processPurchase')->name('purchase.create');
        });
    });

});
