<?php


namespace Src\Endereco\Infrastructure\Eloquent\Repositories;

use Illuminate\Support\Collection;
use Src\Endereco\Domain\Contracts\Repositories\EnderecoEstadoRepository;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;

/**
 * Class EnderecoEstadoEloquentRepository
 *
 * Implementa os métodos de recuperação dos estados utilizando Eloquent.
 *
 * @package Src\Endereco\Infrastructure\Eloquent\Repositories
 */
class EnderecoEstadoEloquentRepository implements EnderecoEstadoRepository
{
    /**
     * Recupera todos os estados cadastrados.
     *
     * @return Collection|EnderecoEstadoEloquentModel[]
     */
    public function getAll(): Collection
    {
        return EnderecoEstadoEloquentModel::all();
    }
}
