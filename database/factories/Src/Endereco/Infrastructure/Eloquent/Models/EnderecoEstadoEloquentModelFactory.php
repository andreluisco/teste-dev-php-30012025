<?php
namespace Database\Factories\Src\Endereco\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;

/**
 * @extends Factory<EnderecoEstadoEloquentModel>
 */
class EnderecoEstadoEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<EnderecoEstadoEloquentModel>
     */
    protected $model = EnderecoEstadoEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' => fake()->unique()->state,
            'uf'     => strtoupper(fake()->lexify('??')),
        ];
    }
}
