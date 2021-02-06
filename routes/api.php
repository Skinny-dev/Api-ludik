<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('v1/player/', 'App\Http\Controllers\Api\v1\PlayerController@index');
Route::get('v1/player/{acepto}', 'App\Http\Controllers\Api\v1\PlayerController@getPlayer');

Route::get('v1/disfraz/{idDisfraz}', 'App\Http\Controllers\Api\v1\PlayerController@getDisfraz');
Route::get('v1/jugador/{idJugador}', 'App\Http\Controllers\Api\v1\PlayerController@getPromedio');
       
