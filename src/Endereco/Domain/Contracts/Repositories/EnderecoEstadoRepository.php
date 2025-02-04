<?php

namespace Src\Endereco\Domain\Contracts\Repositories;

use Illuminate\Support\Collection;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;

/**
 * Interface EnderecoEstadoRepository
 *
 * Responsável por definir os métodos para manipulação dos estados (enderecos).
 *
 * @package Src\Endereco\Domain\Contracts\Repositories
 */
interface EnderecoEstadoRepository
{
    /**
     * Recupera todos os estados.
     *
     * @return Collection|EnderecoEstadoEloquentModel[]
     */
    public function getAll(): Collection;
}
