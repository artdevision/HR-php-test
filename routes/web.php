<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('weather');
});

Route::get('weather', ['as' => 'weather', 'uses' => 'WeatherController@index']);

Route::get('orders/{state?}', ['as' => 'orders', 'uses' => 'OrdersController@index']);

Route::get('order/{id}', ['as' => 'order.edit', 'uses' => 'OrdersController@edit']);
Route::post('order/{id}', ['as' => 'order.edit', 'uses' => 'OrdersController@edit']);