<?php

use Illuminate\Support\Facades\Route;

if ( !function_exists( 'enum_value' ) ) {
    function enum_value( mixed $enum ) : string {
        // if enum is sting and not fully qualified, prepend the namespace
        if (
            is_string( $enum )
            && !str_contains( $enum, '\\' )
        ) {
            $enum = 'App\Enums\\'.$enum;
        }

        return $enum->value;
    }
}

if ( !function_exists( 'RouteRole' ) ) {

    function RouteRole(string $roles,callable $callback )  {
        return Route::middleware('auth:sanctum')->middleware('role:'.$roles)->group($callback);
    }
}
