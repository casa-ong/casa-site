<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnqueteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\Auth\VerificationController;

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

Route::get('/', [HomeController::class, 'index'])->name('site.home');

Route::get('/site/enquete/{id}', [EnqueteController::class, 'ver'])->name('site.enquete.ver');
Route::put('/site/enquete/votar/{id}', [EnqueteController::class, 'votar'])->name('site.enquete.votar');

Route::get('/voluntarios', [UserController::class, 'voluntarios'])->name('site.voluntarios');
Route::get('/voluntarios/norte', [UserController::class, 'voluntariosNorte'])->name('site.voluntarios.norte');
Route::get('/voluntarios/nordeste', [UserController::class, 'voluntariosNordeste'])->name('site.voluntarios.nordeste');
Route::get('/voluntarios/centro', [UserController::class, 'voluntariosCentro'])->name('site.voluntarios.centro');
Route::get('/voluntarios/sudeste', [UserController::class, 'voluntariosSudeste'])->name('site.voluntarios.sudeste');
Route::get('/voluntarios/sul', [UserController::class, 'voluntariosSul'])->name('site.voluntarios.sul');
Route::get('/voluntario/adicionar', [UserController::class, 'adicionar'])->name('site.voluntario.adicionar');
Route::post('/voluntario/adicionar', [UserController::class, 'homeAdicionar'])->name('site.home.voluntario.adicionar');
Route::post('/voluntario/salvar',[UserController::class, 'salvar'])->name('admin.voluntario.salvar');
Route::get('/voluntario/ver/{id}',[UserController::class, 'ver'])->name('admin.voluntario.ver');

Route::get('/eventos', [PublicacaoController::class, 'publicacaos'])->name('site.eventos');
Route::get('/evento/{id}', [PublicacaoController::class, 'publicacao'])->name('site.evento');

Route::get('/projetos', [ProjetoController::class, 'projetos'])->name('site.projetos');
Route::get('/projeto/{id}', [ProjetoController::class, 'projeto'])->name('site.projeto');

Route::get('/noticias', [PublicacaoController::class, 'publicacaos'])->name('site.noticias');
Route::get('/noticia/{id}', [PublicacaoController::class, 'publicacao'])->name('site.noticia');

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::get('/login/sair', [LoginController::class, 'sair'])->name('login.sair');
Route::post('/login/entrar', [LoginController::class, 'entrar'])->name('login.entrar');

Route::get('/sugestao/adicionar', [SugestaoController::class, 'adicionar'])->name('sugestao.adicionar');
Route::post('/sugestao/salvar', [SugestaoController::class, 'salvar'])->name('sugestao.salvar');
Route::get('/sugestao/verify/{id}/{hash}', [Auth\VerificationController::class, 'verifySugestao'])->name('sugestao.verify');

Route::get('/newsletter/adicionar', [NewsletterController::class, 'adicionar'])->name('newsletter.adicionar');
Route::post('/newsletter/salvar', [NewsletterController::class, 'salvar'])->name('newsletter.salvar');
Route::get('/newsletter/editar/{id}/{token}', [NewsletterController::class, 'editar'])->name('newsletter.editar');
Route::put('/newsletter/atualizar/{id}/{token}', [NewsletterController::class, 'atualizar'])->name('newsletter.atualizar');
Route::get('/newsletter/deletar/{id}/{token}', [NewsletterController::class, 'deletar'])->name('newsletter.deletar');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function() {
    Route::get('/admin/voluntario/editar/{id}', [UserController::class, 'editar'])->name('admin.voluntario.editar');
    Route::put('/admin/voluntario/atualizar/{id}', [UserController::class, 'atualizar'])->name('admin.voluntario.atualizar');
    Route::get('/admin/voluntario/deletar/{id}', [UserController::class, 'deletar'])->name('admin.voluntario.deletar');
});

Route::group(['middleware' => 'auth', 'middleware' => 'verified', 'middleware' => 'check.admin'], function() {
    Route::get('/admin/index',['as' => 'admin.index', 'uses' => 'HomeController@adminIndex']);
    Route::get('/admin/projetos',['as' => 'admin.projetos', 'uses' => 'ProjetoController@index']);
    Route::get('/admin/projeto/adicionar',['as' => 'admin.projeto.adicionar', 'uses' => 'ProjetoController@adicionar']);
    Route::post('/admin/projeto/salvar',['as' => 'admin.projeto.salvar', 'uses' => 'ProjetoController@salvar']);
    Route::get('/admin/projeto/editar/{id}',['as' => 'admin.projeto.editar', 'uses' => 'ProjetoController@editar']);
    Route::put('/admin/projeto/atualizar/{id}',['as' => 'admin.projeto.atualizar', 'uses' => 'ProjetoController@atualizar']);
    Route::get('/admin/projeto/deletar/{id}',['as' => 'admin.projeto.deletar', 'uses' => 'ProjetoController@deletar']);

    Route::get('/admin/eventos',['as' => 'admin.eventos', 'uses' => 'PublicacaoController@index']);
    Route::get('/admin/eventos/publicados',['as' => 'admin.eventos.publicados', 'uses' => 'PublicacaoController@indexPublicados']);
    Route::get('/admin/eventos/rascunhos',['as' => 'admin.eventos.rascunhos', 'uses' => 'PublicacaoController@indexRascunhos']);
    Route::get('/admin/evento/adicionar',['as' => 'admin.evento.adicionar', 'uses' => 'PublicacaoController@adicionar']);
    Route::post('/admin/evento/salvar',['as' => 'admin.evento.salvar', 'uses' => 'PublicacaoController@salvar']);
    Route::get('/admin/evento/editar/{id}',['as' => 'admin.evento.editar', 'uses' => 'PublicacaoController@editar']);
    Route::put('/admin/evento/atualizar/{id}',['as' => 'admin.evento.atualizar', 'uses' => 'PublicacaoController@atualizar']);
    Route::get('/admin/evento/deletar/{id}',['as' => 'admin.evento.deletar', 'uses' => 'PublicacaoController@deletar']);
    
    Route::get('/admin/noticias', ['as' => 'admin.noticias', 'uses' => 'PublicacaoController@index']);
    Route::get('/admin/noticias/publicados', ['as' => 'admin.noticias.publicados', 'uses' => 'PublicacaoController@indexPublicados']);
    Route::get('/admin/noticias/rascunhos', ['as' => 'admin.noticias.rascunhos', 'uses' => 'PublicacaoController@indexRascunhos']);
    Route::get('/admin/noticia/adicionar',['as' => 'admin.noticia.adicionar', 'uses' => 'PublicacaoController@adicionar']);
    Route::post('/admin/noticia/salvar',['as' => 'admin.noticia.salvar', 'uses' => 'PublicacaoController@salvar']);
    Route::get('/admin/noticia/editar/{id}',['as' => 'admin.noticia.editar', 'uses' => 'PublicacaoController@editar']);
    Route::put('/admin/noticia/atualizar/{id}',['as' => 'admin.noticia.atualizar', 'uses' => 'PublicacaoController@atualizar']);
    Route::get('/admin/noticia/deletar/{id}',['as' => 'admin.noticia.deletar', 'uses' => 'PublicacaoController@deletar']);

    Route::get('/admin/voluntarios', ['as' => 'admin.voluntarios', 'uses' => 'UserController@index']);
    Route::get('/admin/voluntatio/adicionar',['as' => 'admin.voluntario.adicionar', 'uses' => 'UserController@adicionar']);
    Route::get('/admin/voluntario/aprovar/{id}',['as' => 'admin.voluntario.aprovar', 'uses' => 'UserController@aprovarVoluntario']);
    Route::post('/admin/voluntario/aprovar/admin/',['as' => 'admin.voluntario.aprovar.admin', 'uses' => 'UserController@aprovarAdmin']);

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

    Route::get('/admin/enquetes', [EnqueteController::class, 'index'])->name('admin.enquetes');
    Route::get('/admin/enquete/adicionar', [EnqueteController::class, 'adicionar'])->name('admin.enquete.adicionar');
    Route::post('/admin/enquete/salvar', [EnqueteController::class, 'salvar'])->name('admin.enquete.salvar');
    Route::get('/admin/enquete/atualizar/{id}', [EnqueteController::class, 'atualizar'])->name('admin.enquete.atualizar');
    Route::get('/admin/enquete/deletar/{id}', [EnqueteController::class, 'deletar'])->name('admin.enquete.deletar');

    Route::get('/admin/newsletters', [NewsletterController::class, 'index'])->name('admin.newsletters');

});

Auth::routes();

Route::get('/home', HomeController::class, 'index')->name('home');
