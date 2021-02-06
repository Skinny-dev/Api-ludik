<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/player/{acepto}', App\Http\Controllers\Api\v1\PlayerController::class)  
        ->only(['index']);
Route::get('v1/disfraz/{idDisfraz}', 'App\Http\Controllers\Api\v1\PlayerController@getDisfraz');
Route::get('v1/jugador/{idJugador}', 'App\Http\Controllers\Api\v1\PlayerController@getPromedio');
       
 // Route::get('v1/days/{fecha1}/{fecha2}/{letra}', App\Http\Controllers\Api\v1\PlayerController::days());