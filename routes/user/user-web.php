<?php

use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
->prefix('portal')
->group(function () {

    RouteRole('user|admin',function(){
        Route::controller(PurchaseController::class)->group(function ()
        {
            Route::get('purchase', 'index')->name('purchase.index');
        });
    });

});
