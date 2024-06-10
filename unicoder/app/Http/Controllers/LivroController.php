<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(){
        $livros = Livro::paginate(10);
        return view('livros.index', compact('livros'));
    }
}
