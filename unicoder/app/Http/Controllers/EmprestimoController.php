<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoRequest;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Locatario;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::paginate(10);
        $livros = Livro::all();
        $locatarios = Locatario::all();
        return view('emprestimos.index', compact('emprestimos', 'livros', 'locatarios'));
    }

    public function store(EmprestimoRequest $request)
    {
        $dados = $request->all();

        // Verifica se o livro ainda tem exemplares disponíveis
        $livro = Livro::find($dados['livro_id']);
        if ($livro->quantidade <= 0) {
            toastr()->error('Não há exemplares disponíveis para empréstimo');
            return back();
        }

        $data_devolucao_esperada = date('Y-m-d', strtotime($dados['data_emprestimo'] . ' + ' . $dados['devolucao'] . ' days'));
        $data_emprestimo = date('Y-m-d', strtotime($dados['data_emprestimo']));

        $emprestimo = Emprestimo::create([
            'locatario_id' => $dados['locatario_id'],
            'livro_id' => $dados['livro_id'],
            'data_emprestimo' => $data_emprestimo,
            'data_devolucao_esperada' => $data_devolucao_esperada
        ]);

        $livro->quantidade -= 1;
        $livro->save();

        toastr()->success('Empréstimo realizado com sucesso!');
        return redirect()->route('emprestimos.index');
    }

    public function show($id)
    {
        $emprestimo = Emprestimo::find($id);

        //convertendo datas para o formato brasileiro
        $emprestimo->data_emprestimo = date('d/m/Y', strtotime($emprestimo->data_emprestimo));
        $emprestimo->data_devolucao_esperada = date('d/m/Y', strtotime($emprestimo->data_devolucao_esperada));
        $emprestimo->data_devolucao = $emprestimo->data_devolucao == null ? "Não devolvido" : date('d/m/Y', strtotime($emprestimo->data_devolucao));
        return view('emprestimos.detalhes', compact('emprestimo'));
    }

    public function devolver($id)
    {
        $emprestimo = Emprestimo::find($id);
        $emprestimo->data_devolucao = date('Y-m-d');
        $emprestimo->save();

        $livro = Livro::find($emprestimo->livro_id);
        $livro->quantidade += 1;
        $livro->save();

        toastr()->success('Livro devolvido com sucesso!');

        return back();
    }

    public function renovar($id)
    {
        $emprestimo = Emprestimo::find($id);
        if (
            $emprestimo->quantidade_renovacoes <= 3
            && $emprestimo->data_devolucao == null
            && ($emprestimo->data_devolucao_esperada > date('Y-m-d') || auth()->user()->admin)
        ) {
            $emprestimo->quantidade_renovacoes += 1;
            $emprestimo->data_devolucao_esperada = date('Y-m-d', strtotime($emprestimo->data_devolucao_esperada . ' + 7 days'));
            $emprestimo->save();

            toastr()->success('Livro renovado com sucesso!');

            return back();
        } else {

            toastr()->error('Não foi possível renovar o livro');
            return back();
        }
    }
}
