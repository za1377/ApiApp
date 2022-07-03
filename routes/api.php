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

    Route::get('/Brands', 'show');
    Route::post('/Brand', 'insert');
    Route::put('/Brand', 'update');
    Route::delete('/Brand', 'delete');

});

Route::controller('App\Http\Controllers\CategoriesController')->group(function () {

    Route::get('/Categories', 'show');
    Route::post('/Category', 'insert');
    Route::put('/Category', 'update');
    Route::delete('/Category', 'delete');

});

Route::controller('App\Http\Controllers\AttributeCategoriesController')->group(function () {

    Route::get('/Category/Attributes', 'show');
    Route::post('/Category/Attribute', 'insert');
    Route::put('/Category/Attribute', 'update');
    Route::delete('/Category/Attribute', 'delete');
});

Route::controller('App\Http\Controllers\AttributeController')->group(function () {

    Route::get('/Attributes', 'show');
    Route::post('/Attribute', 'insert');
    Route::put('/Attribute', 'update');
    Route::delete('/Attribute', 'delete');
});

Route::controller('App\Http\Controllers\AttributeTypeController')->group(function () {

    Route::get('/Attribute/Types', 'show');
    Route::post('/Attribute/Type', 'insert');
});

// Route::middleware('Ensure:sanctum')->get('/', function () {
//     return response()->json(['name' => "home"]);
// });
