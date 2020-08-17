<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function(){
    Route::prefix('v1')->namespace('V1')->group(function(){
        Route::apiResource('movie', 'MovieController');
    });
});
