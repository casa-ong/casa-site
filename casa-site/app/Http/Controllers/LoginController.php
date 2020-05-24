<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    
    public function index() 
    {
        return view('login.index');
    }
    
    public function entrar(LoginRequest $request)
    {
        $request->validated();

        $dados = $request->all();
        $user = User::where('email', $dados['email'])->first();

        if($user == null || $user['admin'] == false) {
            return redirect()->route('login')->withErrors(['email' => 'E-mail não cadastrado'])->withInput();
        } else if(Auth::attempt(['email'=>$dados['email'], 'password'=>$dados['password']])) {
            Auth::login($user, false);
            return redirect()->route('admin.index');
        }
        return redirect()->route('login')->withErrors(['password' => 'Senha incorreta, tente novamente'])->withInput();
    }

    public function sair() 
    {
        Auth::logout();
        return redirect()->route('site.home');

    }
}
