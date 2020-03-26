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

Route::get('/',['as' => 'site.home', 'uses' => 'HomeController@index']);

Route::get('/login',['as' => 'login', 'uses' => 'LoginController@index']);
Route::get('/login/sair', ['as' => 'login.sair', 'uses' => 'LoginController@sair']);
Route::post('/login/entrar',['as' => 'login.entrar', 'uses' => 'LoginController@entrar']);


Route::group(['middleware' => 'auth'], function() {
    Route::get('/admin/index',['as' => 'admin.index', 'uses' => 'HomeController@adminIndex']);
    Route::get('/admin/projetos',['as' => 'admin.projetos', 'uses' => 'ProjetoController@index']);
    Route::get('/admin/projeto/adicionar',['as' => 'admin.projeto.adicionar', 'uses' => 'ProjetoController@adicionar']);
    Route::post('/admin/projeto/salvar',['as' => 'admin.projeto.salvar', 'uses' => 'ProjetoController@salvar']);
    Route::get('/admin/projeto/editar/{id}',['as' => 'admin.projeto.editar', 'uses' => 'ProjetoController@editar']);
    Route::put('/admin/projeto/atualizar/{id}',['as' => 'admin.projeto.atualizar', 'uses' => 'ProjetoController@atualizar']);
    Route::get('/admin/projeto/deletar/{id}',['as' => 'admin.projeto.deletar', 'uses' => 'ProjetoController@deletar']);
});
