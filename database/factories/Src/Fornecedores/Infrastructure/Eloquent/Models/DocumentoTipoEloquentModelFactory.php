<?php
namespace Database\Factories\Src\Fornecedores\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Fornecedores\Infrastructure\Eloquent\Models\DocumentoTipoEloquentModel;

/**
 * @extends Factory<DocumentoTipoEloquentModel>
 */
class DocumentoTipoEloquentModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<DocumentoTipoEloquentModel>
     */
    protected $model = DocumentoTipoEloquentModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo' => fake()->randomElement([
                'CPF',
                'CNPJ',
                'RG',
                'Passport'
            ]),
        ];
    }
}
