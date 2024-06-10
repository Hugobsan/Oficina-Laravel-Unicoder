<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'titulo', 'volume', 'edicao', 'paginas', 
        'isbn', 'autor', 'genero', 'editora', 'quantidade'
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
