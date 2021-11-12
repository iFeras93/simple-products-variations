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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/my-orders', [App\Http\Controllers\HomeController::class, 'my_order'])->name('my-order');

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [\App\Http\Controllers\ProductsFrontend::class, 'get_products_list'])->name('products.list');
    Route::get('/{Product:slug}', [\App\Http\Controllers\ProductsFrontend::class, 'get_product_details']);
});
