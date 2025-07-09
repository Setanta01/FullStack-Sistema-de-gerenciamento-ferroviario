<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maquinista;

class MaquinistaSeeder extends Seeder
{
    public function run()
    {
        // Criar 10 maquinistas com funcionários associados
        Maquinista::factory()->count(10)->create();
    }
}
