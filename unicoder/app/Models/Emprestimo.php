<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $table = 'emprestimo';

    protected $fillable = [
        'locatario_id',
        'livro_id',
        'data_emprestimo',
        'data_devolucao_esperada',
        'data_devolucao',
        'quantidade_renovacoes'
    ];

    public function locatario()
    {
        return $this->belongsTo(Locatario::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

}
