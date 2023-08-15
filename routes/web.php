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
    return "It's Work";
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get', 'post'], '/API', 'API@index')->name('index');
Route::match(['get', 'post'], '/API/token', 'API@token')->name('token');
Route::match(['get', 'post'], '/API/users', 'API@users')->name('users');
Route::match(['get', 'post'], '/API/noticias', 'API@noticias')->name('noticias');
Route::match(['get', 'post'], '/API/productos', 'API@productos')->name('productos');
Route::match(['get', 'post'], '/API/maquinarias', 'API@maquinarias')->name('maquinarias');
Route::match(['get', 'post'], '/API/asesorias', 'API@asesorias')->name('asesorias');


Route::match(['get', 'post'], '/API/mix', 'API@mix')->name('mix');


Route::match(['get', 'post'], '/API/newProducto', 'API@newProducto')->name('newProducto');
Route::match(['get', 'post'], '/API/getProducto', 'API@getProducto')->name('getProducto');
Route::match(['get', 'post'], '/API/editProducto', 'API@editProducto')->name('editProducto');
Route::match(['get', 'post'], '/API/delProducto', 'API@delProducto')->name('delProducto');


Route::match(['get', 'post'], '/API/newMaquinaria', 'API@newMaquinaria')->name('newMaquinaria');
Route::match(['get', 'post'], '/API/getMaquinaria', 'API@getMaquinaria')->name('getMaquinaria');
Route::match(['get', 'post'], '/API/editMaquinaria', 'API@editMaquinaria')->name('editMaquinaria');
Route::match(['get', 'post'], '/API/delMaquinaria', 'API@delMaquinaria')->name('delMaquinaria');



Route::match(['get', 'post'], '/API/newNoticia', 'API@newNoticia')->name('newNoticia');
Route::match(['get', 'post'], '/API/getNoticia', 'API@getNoticia')->name('getNoticia');
Route::match(['get', 'post'], '/API/editNoticia', 'API@editNoticia')->name('editNoticia');
Route::match(['get', 'post'], '/API/delNoticia', 'API@delNoticia')->name('delNoticia');



Route::match(['get', 'post'], '/API/newAsesoria', 'API@newAsesoria')->name('newAsesoria');
Route::match(['get', 'post'], '/API/delAsesoria', 'API@delAsesoria')->name('delAsesoria');



Route::match(['get', 'post'], '/API/login', 'API@login')->name('login');


Route::match(['get', 'post'], '/API/expe', 'API@expe')->name('expe');

