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
Route::get('/sugestao/verify/{id}/{hash}', [VerificationController::class, 'verifySugestao'])->name('sugestao.verify');

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
   
    Route::get('/admin/index', [HomeController::class, 'adminIndex' ])->name('admin.index');
    Route::get('/admin/projetos', [ProjetoController::class, 'index' ])->name('admin.projetos');
    Route::get('/admin/projeto/adicionar', [ProjetoController::class, 'adicionar'])->name('admin.projeto.adicionar');
    Route::post('/admin/projeto/salvar', [ProjetoController::class, 'salvar' ])->name('admin.projeto.salvar');
    Route::get('/admin/projeto/editar/{id}', [ProjetoController::class, 'editar' ])->name('admin.projeto.editar');
    Route::put('/admin/projeto/atualizar/{id}', [ProjetoController::class, 'atualizar' ])->name('admin.projeto.atualizar');
    Route::get('/admin/projeto/deletar/{id}', [ProjetoController::class, 'deletar' ])->name('admin.projeto.deletar');

   
    Route::get('/admin/eventos', [PublicacaoController::class, 'index' ])->name('admin.eventos');
    Route::get('/admin/eventos/publicados', [PublicacaoController::class, 'indexPublicados' ])->name('admin.eventos.publicados');
    Route::get('/admin/eventos/rascunhos', [PublicacaoController::class, 'indexRascunhos' ])->name('admin.eventos.rascunhos');
    Route::get('/admin/evento/adicionar', [PublicacaoController::class,'adicionar' ])->name('admin.evento.adicionar');
    Route::post('/admin/evento/salvar', [PublicacaoController::class, 'salvar' ])->name('admin.evento.salvar');
    Route::get('/admin/evento/editar/{id}', [PublicacaoController::class, 'editar' ])->name('admin.evento.editar');
    Route::put('/admin/evento/atualizar/{id}', [PublicacaoController::class, 'atualizar' ])->name('admin.evento.atualizar');
    Route::get('/admin/evento/deletar/{id}', [PublicacaoController::class, 'deletar' ])->name('admin.evento.deletar');
    
    Route::get('/admin/noticias', [PublicacaoController::class,'index' ])->name('admin.noticias');
    Route::get('/admin/noticias/publicados', [PublicacaoController::class, 'indexPublicados' ])->name('admin.noticias.publicados');
    Route::get('/admin/noticias/rascunhos', [PublicacaoController::class, 'indexRascunhos' ])->name('admin.noticias.rascunhos');
    Route::get('/admin/noticia/adicionar', [PublicacaoController::class, 'adicionar' ])->name('admin.noticia.adicionar');
    Route::post('/admin/noticia/salvar', [PublicacaoController::class, 'salvar' ])->name('admin.noticia.salvar');
    Route::get('/admin/noticia/editar/{id}', [PublicacaoController::class, 'editar'])->name('admin.noticia.editar');
    Route::put('/admin/noticia/atualizar/{id}', [PublicacaoController::class, 'atualizar' ])->name('admin.noticia.atualizar');
    Route::get('/admin/noticia/deletar/{id}', [PublicacaoController::class, 'deletar' ])->name('admin.noticia.deletar');

    Route::get('/admin/voluntarios', [UserController::class, 'index' ])->name('admin.voluntarios');
    Route::get('/admin/voluntatio/adicionar', [UserController::class, 'adicionar' ])->name('admin.voluntario.adicionar');
    Route::get('/admin/voluntario/aprovar/{id}', [UserController::class, 'aprovarVoluntario' ])->name('admin.voluntario.aprovar');
    Route::post('/admin/voluntario/aprovar/admin/', [UserController::class, 'aprovarAdmin' ])->name('admin.voluntario.aprovar.admin');

    Route::get('/admin/sobre', [SobreController::class, 'index'])->name('admin.sobre');
    Route::get('/admin/sobre/adicionar', [SobreController::class, 'adicionar' ])->name('admin.sobre.adicionar');
    Route::post('/admin/sobre/salvar', [SobreController::class, 'salvar' ])->name('admin.sobre.salvar');
    Route::get('/admin/sobre/editar/{id}', [SobreController::class,'editar' ])->name('admin.sobre.editar');
    Route::put('/admin/sobre/atualizar/{id}', [SobreController::class, 'atualizar' ])->name('admin.sobre.atualizar');
    Route::get('/admin/sobre/deletar/{id}', [SobreController::class, 'deletar' ])->name('admin.sobre.deletar');

    Route::get('/admin/sugestoes', [SugestaoController::class, 'index' ])->name('admin.sugestoes');
    Route::get('/admin/sugestao/ver/{id}', [SugestaoController::class, 'ver' ])->name('admin.sugestao.ver');
    Route::get('/admin/sugestao/atualizar/{id}', [SugestaoController::class, 'atualizar' ])->name('admin.sugestao.atualizar');
    Route::get('/admin/sugestao/deletar/{id}', [SugestaoController::class, 'deletar' ])->name('admin.sugestao.deletar');

    Route::get('/admin/enquetes', [EnqueteController::class, 'index'])->name('admin.enquetes');
    Route::get('/admin/enquete/adicionar', [EnqueteController::class, 'adicionar'])->name('admin.enquete.adicionar');
    Route::post('/admin/enquete/salvar', [EnqueteController::class, 'salvar'])->name('admin.enquete.salvar');
    Route::get('/admin/enquete/atualizar/{id}', [EnqueteController::class, 'atualizar'])->name('admin.enquete.atualizar');
    Route::get('/admin/enquete/deletar/{id}', [EnqueteController::class, 'deletar'])->name('admin.enquete.deletar');

    Route::get('/admin/newsletters', [NewsletterController::class, 'index'])->name('admin.newsletters');

});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
