<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(){
        $livros = Livro::paginate(10);
        return view('livros.index', compact('livros'));
    }

    public function store(LivroRequest $request){
        $livro = Livro::create($request->all());
        if ($livro instanceof Livro) {
            toastr()->success('Livro cadastrado com sucesso!');
            return redirect()->route('livros.index');
        }

        toastr()->error('Erro ao cadastrar livro!');
        return redirect()->route('livros.index');
    }

    public function show($id){
        $livro = Livro::find($id);
        return view('livros.detalhes', compact('livro'));
    }

    public function update(LivroRequest $request, $id){
        $livro = Livro::find($id);
        $livro->update($request->all());
        toastr()->success('Livro atualizado com sucesso!');
        return redirect()->route('livros.index');
    }
}
