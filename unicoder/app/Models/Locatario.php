<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locatario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'locatario';

    protected $fillable = [
        'nome', 'cpf', 'telefone', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function getCpfAttribute()
    {
        $cpf = $this->attributes['cpf'] ?? '';

        if (strlen($cpf) != 11) {
            return Null;
        }
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^\d]/', '', $value);
    }

    
    public function getTelefoneAttribute()
    {
        if (empty($this->attributes['telefone'])) {
            return Null;
        }
        return sprintf('(%s) %s %s-%s',
            substr($this->attributes['telefone'], 0, 2),
            substr($this->attributes['telefone'], 2, 1),
            substr($this->attributes['telefone'], 3, 4),
            substr($this->attributes['telefone'], 7, 4)
        );
    }

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = preg_replace('/[^\d]/', '', $value);
    }
}
