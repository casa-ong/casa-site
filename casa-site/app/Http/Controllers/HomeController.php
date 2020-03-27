<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projeto;

class HomeController extends Controller
{
    public function index() 
    {
        $registros = Projeto::all();
        return view('home', compact('registros'));
    }

    public function adminIndex()
    {
        $registros = Projeto::all();
        return view('admin.index', compact('registros'));
    }
}
