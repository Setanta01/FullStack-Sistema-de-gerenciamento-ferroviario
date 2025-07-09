<?php

namespace Database\Factories;

use App\Models\Viagem;
use App\Models\Estacao;
use App\Models\Trem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViagemFactory extends Factory
{
    protected $model = Viagem::class;

    public function definition()
    {
        // Cria ou busca estações e trem para relacionamentos
        return [
            'data_partida' => $this->faker->dateTimeBetween('now', '+1 month'),
            'data_chegada' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'estacao_origem_id' => Estacao::factory(),
            'estacao_destino_id' => Estacao::factory(),
            'trem_id' => Trem::factory(),
        ];
    }
}
