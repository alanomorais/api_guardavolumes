<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sobrenome',
        'unidade',
        'enfermaria',
        'leito',
        'acompanhante',
        'dt_alta',
        'observacao',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
