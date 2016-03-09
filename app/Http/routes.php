<?php

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'test' => 'TestController'
]);

Route::group(['prefix' => ''], function () {
    Route::get('/', ['as' => 'store.index', 'uses' => 'StoreController@index']);
    Route::get('category/{id}', ['as' => 'store.category', 'uses' => 'StoreController@category']);
    Route::get('product/{id}', ['as' => 'store.product', 'uses' => 'StoreController@product']);
    Route::get('tag/{id}', ['as' => 'store.tag', 'uses' => 'StoreController@tag']);
    Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@index']);
    Route::get('cart/add/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add']);
    Route::get('cart/destroy/{id}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
    Route::post('cart/update/{id}', ['as' => 'cart.update', 'uses' => 'CartController@update']);
});

// Conta do usuário autenticado
Route::group(['prefix' => 'account', 'middleware'=>'auth', 'where' => ['id' => '[0-9]+']], function(){
    get('', ['as' => 'account', 'uses' => 'AccountController@index']);
    get('/orders', ['as' => 'account_orders', 'uses' => 'AccountController@orders']);
    get('/address', ['as' => 'account_address', 'uses' => 'AccountController@address']);
    get('/address/new', ['as' => 'account_address_new', 'uses' => 'AccountController@addressnew']);
    get('/address/{id}/edit',['as'=>'account_address_edit','uses'=>'AccountController@edit']);
    put('/address/{id}/update',['as'=>'account_address_update','uses'=>'AccountController@update']);
    get('/address/{id}/destroy',['as'=>'account_address_destroy','uses'=>'AccountController@destroy']);
    post('/register/address', ['as' => 'account_address_register', 'uses' => 'AccountController@registerAddress']);
    get('checkout/placeOrder', ['as' => 'checkout.place', 'uses' => 'CheckoutController@place']);
    get('account/orders', ['as' => 'account.orders', 'uses' => 'AccountController@orders']);
    get('/perfil/{id}/edit', ['as' => 'account_perfil', 'uses' => 'AccountController@perfil']);
    put('/perfil/{id}/update',['as'=>'account_perfil_update','uses'=>'AccountController@perfilUpdate']);

});

//Route::get('exemplo', 'WelcomeController@exemplo');
Route::get('home', 'HomeController@index');

Route::get('test', 'CheckoutController@test');

Route::get('evento', function() {
   // \Illuminate\Support\Facades\Event::fire(new CodeCommerce\Events\CheckoutEvent());
    event(new CodeCommerce\Events\CheckoutEvent());
});

Route::post('payment_status', ['as' => 'payment_status', 'uses' => 'CheckoutController@payment_status']);

Route::group(['prefix' => 'admin', 'middleware'=>'auth_admin', 'where' => ['id' => '[0-9]+']], function() {
    Route::get('', ['as' => 'admin', 'uses' => 'CategoriesController@index']);
    get('/orders', ['as' => 'orders', 'uses' => 'OrderController@index']);
    get('/orders/{id}', ['as' => 'order_edit', 'uses' => 'OrderController@edit']);
    put('/orders/{id}/update', ['as' => 'order_update', 'uses' => 'OrderController@update']);
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

        Route::group(['prefix' => 'images'], function() {
            Route::get('{id}/product',['as' => 'products.images', 'uses' => 'ProductsController@images']);
            Route::get('create/{id}/product',['as' => 'products.images.create', 'uses' => 'ProductsController@createImage']);
            Route::post('store/{id}/product',['as' => 'products.images.store', 'uses' => 'ProductsController@storeImage']);
            Route::get('destroy/{id}/image',['as' => 'products.images.destroy', 'uses' => 'ProductsController@destroyImage']);
        });
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('', ['as' => 'users', 'uses' => 'UsersController@index']);
        Route::post('', ['as' => 'users.store', 'uses' => 'UsersController@store']);
        Route::get('create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
        Route::get('{id}/destroy', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
        Route::get('{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
        Route::put('{id}/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    });
});