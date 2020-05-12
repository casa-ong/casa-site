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
// Route::get('/sobre', ['as' => 'site.sobre', 'uses' => 'SobreController@sobre']);


Route::get('/voluntarios', ['as' => 'site.voluntarios', 'uses' => 'UserController@voluntarios']);
Route::get('/voluntarios/norte', ['as' => 'site.voluntarios.norte', 'uses' => 'UserController@voluntariosNorte']);
Route::get('/voluntarios/nordeste', ['as' => 'site.voluntarios.nordeste', 'uses' => 'UserController@voluntariosNordeste']);
Route::get('/voluntarios/centro', ['as' => 'site.voluntarios.centro', 'uses' => 'UserController@voluntariosCentro']);
Route::get('/voluntarios/sudeste', ['as' => 'site.voluntarios.sudeste', 'uses' => 'UserController@voluntariosSudeste']);
Route::get('/voluntarios/sul', ['as' => 'site.voluntarios.sul', 'uses' => 'UserController@voluntariosSul']);
Route::get('/voluntario/adicionar', ['as' => 'site.voluntario.adicionar', 'uses' => 'UserController@adicionar']);
Route::post('/voluntario/adicionar', ['as' => 'site.home.voluntario.adicionar', 'uses' => 'UserController@homeAdicionar']);
Route::post('/admin/voluntario/salvar',['as' => 'admin.voluntario.salvar', 'uses' => 'UserController@salvar']);

Route::get('/eventos', ['as' => 'site.eventos', 'uses' => 'EventoController@eventos']);
Route::get('/evento/{id}', ['as' => 'site.evento', 'uses' => 'EventoController@evento']);

Route::get('/projetos', ['as' => 'site.projetos', 'uses' => 'ProjetoController@projetos']);
Route::get('/projeto/{id}', ['as' => 'site.projeto', 'uses' => 'ProjetoController@projeto']);

Route::get('/noticias', ['as' => 'site.noticias', 'uses' => 'NoticiaController@noticias']);
Route::get('/noticia/{id}', ['as' => 'site.noticia', 'uses' => 'NoticiaController@noticia']);

Route::get('/login',['as' => 'login', 'uses' => 'LoginController@index']);
Route::get('/login/sair', ['as' => 'login.sair', 'uses' => 'LoginController@sair']);
Route::post('/login/entrar',['as' => 'login.entrar', 'uses' => 'LoginController@entrar']);

Route::get('/sugestao/adicionar',['as' => 'sugestao.adicionar', 'uses' => 'SugestaoController@adicionar']);
Route::post('/sugestao/salvar',['as' => 'sugestao.salvar', 'uses' => 'SugestaoController@salvar']);

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function() {
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
    //Route::post('/admin/voluntario/salvar',['as' => 'admin.voluntario.salvar', 'uses' => 'UserController@salvar']);
    Route::get('/admin/voluntario/editar/{id}',['as' => 'admin.voluntario.editar', 'uses' => 'UserController@editar']);
    Route::put('/admin/voluntario/atualizar/{id}',['as' => 'admin.voluntario.atualizar', 'uses' => 'UserController@atualizar']);
    Route::get('/admin/voluntario/deletar/{id}',['as' => 'admin.voluntario.deletar', 'uses' => 'UserController@deletar']);

    Route::get('/admin/sobre', ['as' => 'admin.sobre', 'uses' => 'SobreController@index']);
    Route::get('/admin/sobre/adicionar',['as' => 'admin.sobre.adicionar', 'uses' => 'SobreController@adicionar']);
    Route::post('/admin/sobre/salvar',['as' => 'admin.sobre.salvar', 'uses' => 'SobreController@salvar']);
    Route::get('/admin/sobre/editar/{id}',['as' => 'admin.sobre.editar', 'uses' => 'SobreController@editar']);
    Route::put('/admin/sobre/atualizar/{id}',['as' => 'admin.sobre.atualizar', 'uses' => 'SobreController@atualizar']);
    Route::get('/admin/sobre/deletar/{id}',['as' => 'admin.sobre.deletar', 'uses' => 'SobreController@deletar']);

    Route::get('/admin/sugestoes',['as' => 'admin.sugestoes', 'uses' => 'SugestaoController@index']);
    Route::get('/admin/sugestao/ver/{id}',['as' => 'admin.sugestao.ver', 'uses' => 'SugestaoController@ver']);
    Route::get('/admin/sugestao/atualizar/{id}',['as' => 'admin.sugestao.atualizar', 'uses' => 'SugestaoController@atualizar']);
    Route::get('/admin/sugestao/deletar/{id}',['as' => 'admin.sugestao.deletar', 'uses' => 'SugestaoController@deletar']);

     
    Route::get('/admin/noticias', ['as' => 'admin.noticias', 'uses' => 'NoticiaController@index']);
    Route::get('/admin/noticia/adicionar',['as' => 'admin.noticia.adicionar', 'uses' => 'NoticiaController@adicionar']);
    Route::post('/admin/noticia/salvar',['as' => 'admin.noticia.salvar', 'uses' => 'NoticiaController@salvar']);
    Route::get('/admin/noticia/editar/{id}',['as' => 'admin.noticia.editar', 'uses' => 'NoticiaController@editar']);
    Route::put('/admin/noticia/atualizar/{id}',['as' => 'admin.noticia.atualizar', 'uses' => 'NoticiaController@atualizar']);
    Route::get('/admin/noticia/deletar/{id}',['as' => 'admin.noticia.deletar', 'uses' => 'NoticiaController@deletar']);
   

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
