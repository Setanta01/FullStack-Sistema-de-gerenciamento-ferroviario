<?php

namespace Database\Factories;

use App\Models\Bilhete;
use App\Models\Passageiro;
use App\Models\Viagem;
use Illuminate\Database\Eloquent\Factories\Factory;

class BilheteFactory extends Factory
{
    protected $model = Bilhete::class;

    public function definition()
    {
        return [
            'passageiro_id' => Passageiro::factory(), // cria um passageiro automaticamente
            'viagem_id' => Viagem::factory(),         // cria uma viagem automaticamente
            'assento' => $this->faker->numberBetween(1, 100),
            'data_compra' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'preco' => $this->faker->randomFloat(2, 50, 500),
            'tipo' => $this->faker->randomElement(['', 'Vip', 'Comum']),
        ];
    }
}
