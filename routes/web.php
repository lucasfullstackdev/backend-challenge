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

/**
 * Rotas para a tela de Login
 * =========================================================================
 */
Route::get('/login', ['uses' => 'Controller@fazerLogin']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/cadastro', ['as' => 'user.cadastro', 'uses' => 'Controller@cadastrar']);
Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);

/**
 * Rotas para usuário
 * ===============================================
 */
Route::resource('user', 'UsersController');
Route::get('/list', ['as' => 'user.list', 'uses' => 'UsersController@list']);
Route::get('/users', ['as' => 'user.index', 'uses' => 'UsersController@index']);

Route::get('/users/{id}/upgrade', [ 'as' => 'user.upgrade', 'uses' => 'UsersController@upgrade' ]);
Route::get('/users/{id}/downgrade', [ 'as' => 'user.downgrade', 'uses' => 'UsersController@downgrade' ]);