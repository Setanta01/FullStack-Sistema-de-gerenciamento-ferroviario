<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trem extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'tipo', 'ano_fabricacao', 'velocidade_maxima'];

    public function viagens()
    {
        return $this->hasMany(Viagem::class);
    }

    public function operacoes()
    {
        return $this->hasMany(ViagemOperacao::class);
    }
}