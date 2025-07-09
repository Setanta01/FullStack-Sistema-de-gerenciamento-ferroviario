<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bilhete;

class BilheteSeeder extends Seeder
{
    public function run()
    {
        // Cria 10 bilhetes com dados fake
        Bilhete::factory()->count(10)->create();
    }
}
