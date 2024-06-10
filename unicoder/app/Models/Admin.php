<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'admin';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nome', 'cpf', 'telefone', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCpfAttribute()
    {
        return substr($this->attributes['cpf'], 0, 3) . '.' . substr($this->attributes['cpf'], 3, 3) . '.' . substr($this->attributes['cpf'], 6, 3) . '-' . substr($this->attributes['cpf'], 9, 2);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^\d]/', '', $value);
    }

    
    public function getTelefoneAttribute()
    {
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
