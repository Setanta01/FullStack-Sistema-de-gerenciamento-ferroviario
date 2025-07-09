<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacao extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cidade', 'codigo_postal', 'capacidade_plataformas'];

    public function viagensOrigem()
    {
        return $this->hasMany(Viagem::class, 'estacao_origem_id');
    }

    public function viagensDestino()
    {
        return $this->hasMany(Viagem::class, 'estacao_destino_id');
    }
}
