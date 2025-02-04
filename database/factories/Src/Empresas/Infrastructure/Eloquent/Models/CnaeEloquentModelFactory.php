<?php

namespace Database\Factories\Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Empresas\Infrastructure\Eloquent\Models\CnaeEloquentModel;

/**
 * @extends Factory<CnaeEloquentModel>
 */
class CnaeEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<CnaeEloquentModel>
     */
    protected $model = CnaeEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo'    => fake()->regexify('[A-Z0-9]{10}'),
            'descricao' => fake()->paragraph(),
        ];
    }
}
