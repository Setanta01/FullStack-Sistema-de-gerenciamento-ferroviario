<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'passageiro_id', 'viagem_id',
        'assento', 'data_compra', 'preco', 'tipo'
    ];

    public function passageiro()
    {
        return $this->belongsTo(Passageiro::class);
    }

    public function viagem()
    {
        return $this->belongsTo(Viagem::class);
    }

}
