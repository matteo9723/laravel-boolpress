<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('prova', function(){

    $data = [  
        "name"=>"Ugo",
        "lastname"=>"De Ughi"
    ];
    return response()->json($data);
});




Route::namespace('Api')
    ->prefix('posts')
    ->group(function(){
        Route::get('/', 'PostController@index' );
        Route::get('{slug}', 'PostController@show' );
    });