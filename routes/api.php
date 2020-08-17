<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function(){

    Route::namespace('V1')->prefix('v1')->middleware('client.credentials')->group(function(){
        Route::apiResource('movie', 'MovieController');
        Route::apiResource('turn', 'TurnController');
    });

    Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
});

