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
Route::get('/voluntarios', ['as' => 'site.voluntarios', 'uses' => 'UserController@voluntarios']);
Route::get('/projetos', ['as' => 'site.projetos', 'uses' => 'ProjetoController@projetos']);
Route::get('/eventos', ['as' => 'site.eventos', 'uses' => 'EventoController@eventos']);

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

    Route::get('/admin/eventos',['as' => 'admin.eventos', 'uses' => 'EventoController@index']);
    Route::get('/admin/evento/adicionar',['as' => 'admin.evento.adicionar', 'uses' => 'EventoController@adicionar']);
    Route::post('/admin/evento/salvar',['as' => 'admin.evento.salvar', 'uses' => 'EventoController@salvar']);
    Route::get('/admin/evento/editar/{id}',['as' => 'admin.evento.editar', 'uses' => 'EventoController@editar']);
    Route::put('/admin/evento/atualizar/{id}',['as' => 'admin.evento.atualizar', 'uses' => 'EventoController@atualizar']);
    Route::get('/admin/evento/deletar/{id}',['as' => 'admin.evento.deletar', 'uses' => 'EventoController@deletar']);
    
    Route::get('/admin/voluntarios', ['as' => 'admin.voluntarios', 'uses' => 'UserController@index']);
    Route::get('/admin/voluntatio/adicionar',['as' => 'admin.voluntario.adicionar', 'uses' => 'UserController@adicionar']);
    Route::post('/admin/voluntario/salvar',['as' => 'admin.voluntario.salvar', 'uses' => 'UserController@salvar']);
    Route::get('/admin/voluntario/editar/{id}',['as' => 'admin.voluntario.editar', 'uses' => 'UserController@editar']);
    Route::put('/admin/voluntario/atualizar/{id}',['as' => 'admin.voluntario.atualizar', 'uses' => 'UserController@atualizar']);
    Route::get('/admin/voluntario/deletar/{id}',['as' => 'admin.voluntario.deletar', 'uses' => 'UserController@deletar']);

    Route::get('/admin/dados_site', ['as' => 'admin.dados_site', 'uses' => 'DadosSiteController@index']);
    Route::get('/admin/dados_site/adicionar',['as' => 'admin.dados_site.adicionar', 'uses' => 'DadosSiteController@adicionar']);
    Route::post('/admin/dados_site/salvar',['as' => 'admin.dados_site.salvar', 'uses' => 'DadosSiteController@salvar']);
    Route::get('/admin/dados_site/editar/{id}',['as' => 'admin.dados_site.editar', 'uses' => 'DadosSiteController@editar']);
    Route::put('/admin/dados_site/atualizar/{id}',['as' => 'admin.dados_site.atualizar', 'uses' => 'DadosSiteController@atualizar']);
    Route::get('/admin/dados_site/deletar/{id}',['as' => 'admin.dados_site.deletar', 'uses' => 'DadosSiteController@deletar']);
});
