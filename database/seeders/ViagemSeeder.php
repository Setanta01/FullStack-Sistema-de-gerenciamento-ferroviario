<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viagem;

class ViagemSeeder extends Seeder
{
    public function run()
    {
        Viagem::factory()->count(10)->create();
    }
}