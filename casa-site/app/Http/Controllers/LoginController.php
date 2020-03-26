<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function index() 
    {
        return view('login.index');
    }
    
    public function entrar(Request $request)
    {
        // Pegar dados do usuario para verificar se eh admin
        $dados = $request->all();
        $user = User::where('email', $dados['email'])->first();

        if($user->admin == true && Auth::attempt(['email'=>$dados['email'], 'password'=>$dados['senha']]))
        {
            return redirect()->route('admin.index');
        }
        return redirect()->route('login');
    }

    public function sair() 
    {
        Auth::logout();
        return redirect()->route('site.home');

    }
}
