<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estacao;

class EstacaoSeeder extends Seeder
{
    public function run()
    {
        Estacao::factory()->count(10)->create();
    }
}
