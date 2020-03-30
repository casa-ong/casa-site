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
        $registros = Projeto::all()->reverse();
        $sobre = Sobre::latest('updated_at')->first();
        $noticias = Noticia::all()->reverse();
        return view('home', compact('registros', 'sobre', 'noticias'));
    }

    public function adminIndex()
    {
        $registros = Projeto::all();
        return view('admin.index', compact('registros'));
    }
}
