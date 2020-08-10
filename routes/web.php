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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('cidades/get/{id}', 'UnidadeController@getCidades');

Route::group(['middleware' => 'auth'], function () {
	
	Route::resource('user', 'UserController', ['except' => ['show']]);	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::resource('empresas', 'EmpresaController');
	Route::resource('unidades', 'UnidadeController',['except' => ['show']]);
	Route::resource('usuarios', 'UsuarioController');
	Route::resource('contratos', 'ContratoController');

	Route::post('unidades/{unidadeId}/usuarios/{usuarioId}/atestados/store', 'AtestadoController@store');
	Route::get('unidades/{unidadeId}/usuarios/{usuarioId}/atestados','AtestadoController@index');
	Route::get('unidades/{id}/usuarios/create','UsuarioController@create');
	Route::post('unidades/{id}/usuarios/store','UsuarioController@store');
	Route::get('unidades/{id}/usuarios','UsuarioController@index');
});

