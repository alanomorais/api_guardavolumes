<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleArmario extends Model
{
    use HasFactory;
    protected $fillable = [
        'armario_id',
        'paciente_id',
        'user_id',
        'dt_inicio',
        'dt_fim',
        'situacao',
        'obs'

    ];

    protected $table = 'mv_armarios';

    public function armario()
    {
        return $this->belongsTo(Armario::class);
    }
    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
