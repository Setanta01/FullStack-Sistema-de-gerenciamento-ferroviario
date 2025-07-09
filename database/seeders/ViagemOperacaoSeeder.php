<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ViagemOperacao;

class ViagemOperacaoSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 operações de viagem com dados relacionados
        ViagemOperacao::factory()->count(10)->create();
    }
}
