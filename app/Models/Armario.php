<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armario extends Model
{
    use HasFactory;
    protected $fillable = [
        'unidade',
        'codigo',
        'situacao',
        'user_id'
    ];

    public function mvarmarios()
    {
        return $this->hasMany(ControleArmario::class);
    }

    public function mvarmario()
    {
        return $this->hasOne(ControleArmario::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

}
