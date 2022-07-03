<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanctumController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/home', 'App\Http\Controllers\SanctumController@home');
// Route::post('/login',function () {
//     return response()->json(["message" => "login route"], 200);
// });

Route::post('/login', 'App\Http\Controllers\SanctumController@logIn');

Route::controller('App\Http\Controllers\BrandsController')->group(function () {

    Route::get('Show/Brands', 'show');
    Route::post('New/Brands', 'insert');
    Route::put('/Update/Brands', 'update');
    Route::delete('Delete/Brands', 'delete');

});

Route::controller('App\Http\Controllers\CategoriesController')->group(function () {

    Route::get('Show/Categories', 'show');
    Route::post('New/Categories', 'insert');
    Route::put('Update/Categories', 'update');
    Route::delete('Delete/Categories', 'delete');

});

Route::controller('App\Http\Controllers\AttributeCategoriesController')->group(function () {

    Route::get('Show/Categories/Attribute', 'show');
    Route::post('New/Categories/Attribute', 'insert');
    Route::put('/Update/Categories/Attribute', 'update');
    Route::delete('/Delete/Categories/Attribute', 'delete');
});

Route::controller('App\Http\Controllers\AttributeController')->group(function () {

    Route::get('/Show/Attributes', 'show');
});

// Route::middleware('Ensure:sanctum')->get('/', function () {
//     return response()->json(['name' => "home"]);
// });
