<?php

namespace Database\Factories\Src\Fornecedores\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Models\DocumentoTipoEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

/**
 * @extends Factory<FornecedorEloquentModel>
 */
class FornecedorEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<FornecedorEloquentModel>
     */
    protected $model = FornecedorEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'                 => fake()->company(),
            'documento_tipo_id'    => DocumentoTipoEloquentModel::factory(),
            'documento_numero'     => fake()->numerify('##############'),
            'endereco_id'          => EnderecoEloquentModel::factory(),
            'endereco_numero'      => fake()->numerify('###'),
            'endereco_complemento' => fake()->optional()->word(),
            'created_at'           => now(),
            'updated_at'           => now(),
        ];
    }
}
