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

    $status = 'Ok';

    $user = [
        "name"=>"Ugo",
        "lastname"=>"De Ughi",
        'hobbies' => [
            'golf',
            'culing',
            'bocce'
        ],
    ];

    return response()->json(compact('status', 'user'));
});





Route::namespace('Api')
    ->group(function(){
        Route::get('/posts', 'PostController@index');
        Route::get('posts/{slug}', 'PostController@show');
        Route::get('posts/postcategory/{slug}', 'PostController@getPostsByCategory');
        Route::get('posts/posttag/{slug}', 'PostController@getPostsByTag');
        Route::post('contacts/', 'ContactController@store');
    });
