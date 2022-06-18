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

Route::post('/NewBrands', 'App\Http\Controllers\BrandsController@insert');
Route::put('/UpdateBrands', 'App\Http\Controllers\BrandsController@update');
Route::delete('/DeleteBrands', 'App\Http\Controllers\BrandsController@delete');


// Route::middleware('Ensure:sanctum')->get('/', function () {
//     return response()->json(['name' => "home"]);
// });
