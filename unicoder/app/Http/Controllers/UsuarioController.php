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

    public function index(){
        $usuarios = User::doesntHave('admin')
        ->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function show($id){
        $usuario = User::find($id);
        return view('usuarios.perfil', compact('usuario'));
    }

    public function update(Request $request, $id){
        $usuario = User::find($id);
        $dados = $request->all();

        if ($dados['old_password'] != null && $dados['new_password'] != null) {
            if($dados['new_password'] != $dados['confirm_password']){
                toastr()->error('As senhas não conferem');
                return back();
            }
            else if (password_verify($dados['old_password'], $usuario->password)) {
                $usuario->password = bcrypt($dados['new_password']);
            } else {
                toastr()->error('Senha atual incorreta');
                return back();
            }
        }
        $usuario->name = $dados['name'];
        $usuario->email = $dados['email'];
        $usuario->locatario->nome = $dados['name'];
        $usuario->locatario->telefone = $dados['telefone'];
        $usuario->locatario->cpf = $dados['cpf'];
        $usuario->locatario->save();
        $usuario->save();

        toastr()->success('Usuário atualizado com sucesso');
        return redirect()->route('users.show', $id);
    }

}
