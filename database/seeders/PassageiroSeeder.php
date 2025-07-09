<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passageiro;

class PassageiroSeeder extends Seeder
{
    public function run()
    {
        // Cria 10 passageiros com dados fake
        Passageiro::factory()->count(10)->create();
        
    }
}
