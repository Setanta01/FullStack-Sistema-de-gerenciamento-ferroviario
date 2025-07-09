<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViagemOperacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'viagem_id', 'trem_id',
        'maquinista_id', 'turno', 'observacoes'
    ];

    public function viagem()
    {
        return $this->belongsTo(Viagem::class);
    }

    public function trem()
    {
        return $this->belongsTo(Trem::class);
    }

    public function maquinista()
    {
        return $this->belongsTo(Maquinista::class);
    }
}
