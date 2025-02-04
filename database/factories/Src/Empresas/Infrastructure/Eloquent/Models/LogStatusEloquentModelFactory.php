<?php

namespace Database\Factories\Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;

/**
 * @extends Factory<LogStatusEloquentModel>
 */
class LogStatusEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<LogStatusEloquentModel>
     */
    protected $model = LogStatusEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['pending', 'success', 'failed']),
        ];
    }
}
