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

Route::post('/login', 'App\Http\Controllers\SanctumController@logIn');

Route::middleware(['auth:sanctum'])->group(function () {

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
        Route::put('/Attribute/Type', 'update');
        Route::delete('/Attribute/Type', 'delete');

    });

    Route::controller('App\Http\Controllers\AttributeValueController')->group(function () {

        Route::get('/Attribute/Values', 'show');
        Route::post('/Attribute/Value', 'insert');
        Route::put('/Attribute/Value', 'update');
        Route::delete('/Attribute/Value', 'delete');
    });

    Route::controller('App\Http\Controllers\BrandCategoryController')->group(function () {

        Route::get('/Category/Brands', 'show');
        Route::post('/Category/Brand', 'insert');
        Route::put('/Category/Brand', 'update');
        Route::delete('/Category/Brand', 'delete');
    });

    Route::controller('App\Http\Controllers\CateAttrCateController')->group(function () {

        Route::get('/Cate/Attr/Cates', 'show');
        Route::post('/Cate/Attr/Cate', 'insert');
        Route::put('/Cate/Attr/Cate', 'update');
        Route::delete('/Cate/Attr/Cate', 'delete');
    });

    Route::controller('App\Http\Controllers\AttrTypeCAAController')->group(function () {

        Route::get('/CACA/AttributeTypes', 'show');
        Route::post('/CACA/AttributeType', 'insert');
        Route::put('/CACA/AttributeType', 'update');
        Route::delete('/CACA/AttributeType', 'delete');
    });

    Route::controller('App\Http\Controllers\AttrValCAAController')->group(function () {

        Route::get('/Category/AttributeCategory/Attribute/Values', 'show');
        Route::post('/Category/AttributeCategory/Attribute/Value', 'insert');
        Route::put('/Category/AttributeCategory/Attribute/Value', 'update');
        Route::delete('/Category/AttributeCategory/Attribute/Value', 'delete');
    });

    Route::controller('App\Http\Controllers\CACAController')->group(function () {

        Route::get('/CACAs', 'show');
        Route::post('/CACA', 'insert');
        Route::put('/CACA', 'update');
        Route::delete('/CACA', 'delete');
    });


});



