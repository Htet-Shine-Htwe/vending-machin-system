<?php

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\PurchaseApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')
->prefix('user')
->group(function () {

    RouteRole('user|admin|officer',function(){
        Route::controller(PurchaseApiController::class)->group(function ()
        {
            Route::get('purchase', 'index')->name('purchase.index');
        });

        Route::controller(ProductApiController::class)->group(function ()
        {
            Route::post('purchase/create', 'processPurchase')->name('purchase.create');
        });
    });

});
