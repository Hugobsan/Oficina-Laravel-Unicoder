<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use App\Models\Locatario;
use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function create(){
        return view('autenticacao.registrar');
    }

    public function store(RegistroRequest $request){
        $dados = $request->all();
        $user = User::create([
            'name' => $dados['nome'],
            'email' => $dados['email'],
            'password' => bcrypt($dados['password'])
        ]);
        

        $locatario = $user->locatario()->create(['nome' => $dados['nome']]);

        if ( $locatario instanceof Locatario && $user instanceof User){
            toastr()->success('Cadastro realizado com sucesso');
            return redirect()->route('login');
        }

        toastr()->error('Erro ao realizar o cadastro');
        return back();
    }
}
