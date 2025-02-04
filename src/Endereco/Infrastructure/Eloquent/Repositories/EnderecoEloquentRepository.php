<?php

namespace Src\Endereco\Infrastructure\Eloquent\Repositories;

use Src\Endereco\Domain\Contracts\Repositories\EnderecoRepository;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;

/**
 * Class EnderecoEloquentRepository
 *
 * Implementa a criação de endereços utilizando Eloquent.
 *
 * @package Src\Endereco\Infrastructure\Eloquent\Repositories
 */
class EnderecoEloquentRepository implements EnderecoRepository
{
    /**
     * Cria um novo endereço a partir dos dados fornecidos.
     *
     * @param array $data
     *
     * @return EnderecoEloquentModel
     */
    public function create(array $data): EnderecoEloquentModel
    {
        return EnderecoEloquentModel::create($data);
    }
}
