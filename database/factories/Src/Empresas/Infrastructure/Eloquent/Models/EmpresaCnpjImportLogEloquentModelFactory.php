<?php

namespace Database\Factories\Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;

/**
 * @extends Factory<EmpresaCnpjImportLogEloquentModel>
 */
class EmpresaCnpjImportLogEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<EmpresaCnpjImportLogEloquentModel>
     */
    protected $model = EmpresaCnpjImportLogEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnpj'          => fake()->numerify('##############'),
            'log_status_id' => LogStatusEloquentModel::factory(),
            // Gera um novo status se necessário
            'attempts'      => fake()->numberBetween(0, 3),
            'error_message' => fake()
                ->optional()
                ->sentence(),
        ];
    }
}
