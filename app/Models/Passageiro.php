<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passageiro extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'documento', 'telefone', 'email'];

    public function bilhetes()
    {
        return $this->hasMany(Bilhete::class);
    }

    public function viagens()
    {
        return $this->belongsToMany(Viagem::class, 'bilhetes');
    }
}
