<?php

namespace Database\Factories\Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Empresas\Infrastructure\Eloquent\Models\QsaEloquentModel;

/**
 * @extends Factory<QsaEloquentModel>
 */
class QsaEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<QsaEloquentModel>
     */
    protected $model = QsaEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empresa_id'             => fake()->numberBetween(1, 10),
            'nome_socio'             => fake()->name(),
            'cnpj_cpf_socio'         => fake()
                ->optional()
                ->numerify('##############'),
            'qualificacao_socio'     => fake()->jobTitle(),
            'data_entrada_sociedade' => fake()
                ->optional()
                ->date(),
            'created_at'             => now(),
            'updated_at'             => now(),
        ];
    }
}
