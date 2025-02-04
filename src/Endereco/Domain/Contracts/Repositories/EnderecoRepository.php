<?php

namespace Src\Endereco\Domain\Contracts\Repositories;

use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;

/**
 * Interface EnderecoRepository
 *
 * Responsável por definir os métodos para manipulação dos endereços.
 *
 * @package Src\Endereco\Domain\Contracts\Repositories
 */
interface EnderecoRepository
{
    /**
     * Cria um novo endereço com os dados informados.
     *
     * @param array $data
     * @return EnderecoEloquentModel
     */
    public function create(array $data): EnderecoEloquentModel;
}
