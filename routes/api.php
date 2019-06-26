<?php

    use Illuminate\Http\Request;

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::get('/products', 'ProductController@index');
    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/{category}','CategoryController@show');
    Route::post('/upload-file', 'ProductController@uploadFile');
    Route::post('/upload-file-order', 'OrderController@uploadFile');
    Route::get('/cart', 'CartController@show');
    Route::get('/orders', 'CartController@index');
    Route::post('/cart', 'CartController@store');
    Route::get('/products/{product}', 'ProductController@show');
    Route::get('/checkout', 'CheckoutController@index')->name('checkout');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/users','UserController@index');
        Route::get('users/{user}','UserController@show');
        Route::patch('users/{user}','UserController@update');
        Route::get('users/{user}/orders','UserController@showOrders');
        Route::post('categories/{category}','CategoryController@destroy');
        Route::post('products/{product}','ProductController@destroy');
        Route::post('users/{user}','UserController@destroy');
        Route::patch('products/{product}/units/add','ProductController@updateUnits');
        Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
        Route::resource('/orders', 'OrderController');
        Route::resource('/carts', 'CartController');
        Route::resource('/users', 'UserController')->except(['index', 'show', 'login', 'register']);
        Route::resource('/products', 'ProductController')->except(['index','show']);
        Route::resource('/categories', 'CategoryController')->except(['index','show']);
    });
