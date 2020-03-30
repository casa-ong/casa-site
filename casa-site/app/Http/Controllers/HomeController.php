<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;
use App\Sobre;

class HomeController extends Controller
{
    public function index() 
    {
        $registros = Projeto::all()->reverse();
        $sobre = Sobre::latest('updated_at')->first();
        return view('home', compact('registros', 'sobre'));
    }

    public function adminIndex()
    {
        $registros = Projeto::all();
        return view('admin.index', compact('registros'));
    }
}
