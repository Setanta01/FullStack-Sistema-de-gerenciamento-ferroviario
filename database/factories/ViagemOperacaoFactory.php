<?php

namespace Database\Factories;

use App\Models\ViagemOperacao;
use App\Models\Viagem;
use App\Models\Trem;
use App\Models\Maquinista;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViagemOperacaoFactory extends Factory
{
    protected $model = ViagemOperacao::class;

    public function definition()
    {
        return [
            // Associa com registros existentes ou cria novos automaticamente
            'viagem_id' => Viagem::factory(),
            'trem_id' => Trem::factory(),
            'maquinista_id' => Maquinista::factory(),

            'turno' => $this->faker->randomElement(['Manhã', 'Tarde', 'Noite']),
            'observacoes' => $this->faker->optional()->sentence(),
        ];
    }
}
