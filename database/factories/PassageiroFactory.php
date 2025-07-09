<?php

namespace Database\Factories;

use App\Models\Passageiro;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassageiroFactory extends Factory
{
    protected $model = Passageiro::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'documento' => $this->faker->unique()->numerify('###########'), // CPF sem pontuação (se preferir, use outro formato)
            'telefone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
