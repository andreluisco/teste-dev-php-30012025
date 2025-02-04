<?php

namespace Database\Factories\Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;

/**
 * @extends Factory<EmpresaEloquentModel>
 */
class EmpresaEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<EmpresaEloquentModel>
     */
    protected $model = EmpresaEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnpj'                  => fake()->numerify('##############'),
            'razao_social'          => fake()->company(),
            'nome_fantasia'         => fake()
                ->optional()
                ->companySuffix(),
            'situacao_cadastral'    => fake()->word(),
            'data_inicio_atividade' => fake()->date(),
            'porte'                 => fake()->randomElement([
                'MEI',
                'EPP',
                'Grande Porte'
            ]),
            'created_at'            => now(),
            'updated_at'            => now(),
        ];
    }
}
