<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trem;

class TremSeeder extends Seeder
{
    public function run()
    {
        Trem::factory()->count(10)->create();
    }
}
