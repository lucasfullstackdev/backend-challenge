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

Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/cadastro', ['uses' => 'Controller@cadastrar']);

/**
 * Routes to user auth
 * ===============================================
 */
Route::get('/login', ['uses' => 'Controller@fazerLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);

/**
 * Routes to sign in & list
 * ===============================================
 */
Route::resource('user', 'UsersController');
Route::get('/users', ['as' => 'user.list', 'uses' => 'UsersController@list']);
Route::get('/list', ['as' => 'user.index', 'uses' => 'UsersController@index']);
Route::get('/users/{id}/upgrade', [ 'as' => 'user.upgrade', 'uses' => 'UsersController@upgrade' ]);
Route::get('/users/{id}/downgrade', [ 'as' => 'user.downgrade', 'uses' => 'UsersController@downgrade' ]);

/** ============================================= */
Route::get('/recuperar-senha', ['uses' => 'Controller@recuperarSenha']);
Route::post('/recuperar-senha', ['as' => 'user.recuperar-senha', 'uses' => 'Controller@recuperarSenha']);
