<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware(['codecov.insights'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });


    Route::group(['namespace' => '\App\Http\Controllers'], function () {
        Route::get('/example', 'ExampleController@index')->name('example');
    });
});
