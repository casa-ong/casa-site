<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use App\Sobre;
use App\Noticia;

class HomeController extends Controller
{
    public function index() 
    {
        $registros = Projeto::where('publicado', 1)->latest()->paginate(3);
        $sobre = Sobre::latest('updated_at')->first();
        $noticias = Noticia::where('publicado', 1)->latest()->paginate(3);
        return view('home', compact('registros', 'sobre', 'noticias'));
    }

    public function adminIndex()
    {
        return view('admin.index');
    }
}
