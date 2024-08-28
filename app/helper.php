<?php

use Illuminate\Support\Facades\Storage;

if(!function_exists('tryCatch')){

    function tryCatch($callback, $message = null,$withException=false){
        try{
            return $callback();
        }catch(\Exception $e){

            $status = 500;
            if($e instanceof \Illuminate\Validation\ValidationException){
                $status = 422;
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ],$status);
            }

            if($withException)
            {
                $message .= " " . $e->getMessage();
            }

            return response()->json(['message' => $message],$status);
        }
    }
}
