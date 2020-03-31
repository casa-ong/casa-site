<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;
use Validator;

class UserController extends Controller
{

    public function voluntarios() 
    {
        $registros = User::all()->reverse();
        return view('voluntarios', compact('registros'));
    }

    
    public function index() 
    {
        $registros = User::all()->reverse();
        return view('admin.voluntarios.index', compact('registros'));
    }

    public function adicionar() 
    {
        return view('admin.voluntarios.adicionar');
    }

    // Método responsavel por salvar as informacoes do formulario de criacao no banco de dados
    public function salvar(Request $request) 
    {
        $dados = $request->all();
        
        // Validar campos ao salvar
        $validarDados = Validator::make($dados, [
            'name' => 'required|min:3', //Definir os campos que são obrigatórios com required
            'cpf' => 'required|regex:/\d{3}\.\d{3}\.\d{3}\-\d{2}/', //Definir o mínimo de letras no campo com min:x
            'descricao' => 'required|min:3',
            'profissao' => 'required|min:3',
            'foto' => 'image',
            'email' => 'required|email|unique:users',
            'telefone' => 'regex:/\(?\d{2}\)?\s?\d{5}\-?\d{4}/',
            'password' => 'nullable|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/|confirmed',

        ],[
            'name.required' => 'O campo nome é obrigatório', //Definir a mensagem de erro para cada tipo de erro de cada campo
            'name.min' => 'O campo nome deve ter no mínimo 3 letras',
            'cpf.required' => 'O campo de cpf é obrigatório',
            'cpf.regex' => 'CPF inválido',
            'profissao.required' => 'O campo profissão deve ser preenchido',
            'profissao.min' => 'O campo profissão deve ter no mínimo 3 letras',
            'descricao.required' => 'O texto da descrição deve ser preenchido',
            'descricao.min' => 'O texto da descrição deve ter no mínimo 3 letras',
            'foto.image' => 'A imagem deve ser no formato jpeg, png, bmp, gif, svg ou webp',
            'email.required' => 'O campo de email é obrigatório',
            'email.email' => 'Digite um endereço de email',
            'email.unique' => 'O email digitado já foi cadastrado',
            'telefone.regex' => 'O número deve ser no formato (81)99999-9999',
            'password.regex' => 'Senha deve conter ao menos uma letra e um número e no mínimo 8 digitos',
            'password.confirmed' => 'As senhas não conferem'
        ]);
            
        if($validarDados->fails()) { //Isso retorna o erro com mensagem para view
            return redirect()->back()->withErrors($validarDados->errors())->withInput();
        }

        if(Auth::guest() && (isset($dados['admin']) || isset($dados['aprovado']))) {
            return redirect()->route('site.voluntario.adicionar');
        }
        
        if(!isset($dados['password'])) {
            $dados['password'] = 'admin';
        }

        $dados['password'] = bcrypt($dados['password']);
        

        if(isset($dados['admin'])) {
            $dados['admin'] = true;
        } else {
            $dados['admin'] = false;
        }

        if(isset($dados['aprovado'])) {
            $dados['aprovado'] = true;
        } else {
            $dados['aprovado'] = false;
        }

        if($request->hasFile('foto')) {
            $anexo = $request->file('foto');
            $num = rand(1111,9999);
            $dir = 'img/voluntarios/';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'foto_'.$dados['cpf'].'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['foto'] = $dir.'/'.$nomeAnexo;
        }

        User::create($dados);

        return redirect()->route('site.voluntarios');
    }

    // Método responsavel por abrir a pagina de editar um projeto
    public function editar($id) 
    {
        $registro = User::find($id);
        return view('admin.voluntarios.editar', compact('registro'));
    }

    // Método responsavel por salvar as informacoes do formulario de edicao no banco de dados
    public function atualizar(Request $request, $id) 
    {
        $dados = $request->all();

        $dados['password'] = bcrypt($dados['password']);
        
        if(isset($dados['admin'])) {
            $dados['admin'] = true;
        } else {
            $dados['admin'] = false;
        }

        if(isset($dados['aprovado'])) {
            $dados['aprovado'] = true;
        } else {
            $dados['aprovado'] = false;
        }

        if($request->hasFile('foto')) {
            $anexo = $request->file('foto');
            $num = rand(1111,9999);
            $dir = 'img/voluntarios';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'foto_'.$dados['cpf'].'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['foto'] = $dir.'/'.$nomeAnexo;
        }

        User::find($id)->update($dados);

        return redirect()->route('admin.voluntarios');
    }

    // Metodo da acao de apagar um projeto
    public function deletar($id) 
    {
        User::find($id)->delete();
        return redirect()->route('admin.voluntarios');
    }
}
