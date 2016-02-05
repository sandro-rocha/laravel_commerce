<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('exemplo', 'WelcomeController@exemplo');
Route::get('home', 'HomeController@index');
Route::group(['prefix' => 'categories'], function() {
    Route::get('', ['as' => 'categories', 'uses' => 'CategoriesController@index']);
    Route::post('', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
    Route::get('create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
    Route::get('{id}/destroy', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);
    Route::get('{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
    Route::put('{id}/update', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
});
Route::group(['prefix' => 'products'], function() {
    Route::get('', ['as' => 'products', 'uses' => 'ProductsController@index']);
    Route::post('', ['as' => 'products.store', 'uses' => 'ProductsController@store']);
    Route::get('create', ['as' => 'products.create', 'uses' => 'ProductsController@create']);
    Route::get('{id}/destroy', ['as' => 'products.destroy', 'uses' => 'ProductsController@destroy']);
    Route::get('{id}/edit', ['as' => 'products.edit', 'uses' => 'ProductsController@edit']);
    Route::put('{id}/update', ['as' => 'products.update', 'uses' => 'ProductsController@update']);
});
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'categories'], function(){
        Route::get('', ['as' => 'admin.categories.index', 'uses' => 'AdminCategoriesController@index']);
        Route::get('create', ['as' => 'admin.categories.create', 'uses' => 'AdminCategoriesController@index']);
        Route::get('store', ['as' => 'admin.categories.store', 'uses' => 'AdminCategoriesController@index']);
        Route::get('show/{id?}', ['as' => 'admin.categories.show', 'uses' => 'AdminCategoriesController@index']);
        Route::get('edit/{id?}', ['as' => 'admin.categories.edit', 'uses' => 'AdminCategoriesController@index']);
        Route::get('update/{id?}', ['as' => 'admin.categories.update', 'uses' => 'AdminCategoriesController@index']);
        Route::get('destroy/{id?}', ['as' => 'admin.categories.destroy', 'uses' => 'AdminCategoriesController@index']);
    });
    Route::group(['prefix' => 'products'], function(){
        Route::get('', ['as' => 'admin.products.index', 'uses' => 'AdminProductsController@index']);
        Route::get('create', ['as' => 'admin.products.create', 'uses' => 'AdminProductsController@index']);
        Route::get('store', ['as' => 'admin.products.store', 'uses' => 'AdminProductsController@index']);
        Route::get('show/{id?}', ['as' => 'admin.products.show', 'uses' => 'AdminProductsController@index']);
        Route::get('edit/{id?}', ['as' => 'admin.products.edit', 'uses' => 'AdminProductsController@index']);
        Route::get('update/{id?}', ['as' => 'admin.products.update', 'uses' => 'AdminProductsController@index']);
        Route::get('destroy/{id?}', ['as' => 'admin.products.destroy', 'uses' => 'AdminProductsController@index']);
    });
});