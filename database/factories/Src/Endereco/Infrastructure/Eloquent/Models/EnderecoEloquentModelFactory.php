<?php

namespace Database\Factories\Src\Endereco\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;

/**
 * @extends Factory<EnderecoEloquentModel>
 */
class EnderecoEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<EnderecoEloquentModel>
     */
    protected $model = EnderecoEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cep'        => fake()->numerify('#####-###'),
            'estado_id'  => EnderecoEstadoEloquentModel::factory(),
            'cidade'     => fake()->city(),
            'bairro'     => fake()->word(),
            'logradouro' => fake()->streetAddress(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
