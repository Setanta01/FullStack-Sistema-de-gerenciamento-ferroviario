<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_partida', 'data_chegada',
        'estacao_origem_id', 'estacao_destino_id',
        'trem_id'
    ];

    public function estacaoOrigem()
    {
        return $this->belongsTo(Estacao::class, 'estacao_origem_id');
    }

    public function estacaoDestino()
    {
        return $this->belongsTo(Estacao::class, 'estacao_destino_id');
    }

    public function trem()
    {
        return $this->belongsTo(Trem::class);
    }

    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }

    public function passageiros()
    {
        return $this->belongsToMany(Passageiro::class, 'bilhetes');
    }

    public function operacoes()
    {
        return $this->hasMany(ViagemOperacao::class);
    }
    
}
