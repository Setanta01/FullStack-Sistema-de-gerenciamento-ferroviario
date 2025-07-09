<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinista extends Model
{
    use HasFactory;

    protected $fillable = ['funcionario_id', 'licenca', 'tempo_experiencia', 'data_validade', 'categoria_licenca'];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function operacoes()
    {
        return $this->hasMany(ViagemOperacao::class);
    }
}
