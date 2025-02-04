<?php

namespace Src\Empresas\Domain\Contracts\Repositories;

use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;

interface EmpresaRepository
{
    /**
     * Busca uma empresa pelo CNPJ.
     *
     * @param string $cnpj
     * @return EmpresaEloquentModel|null
     */
    public function findByCnpj(string $cnpj): ?EmpresaEloquentModel;

    /**
     * Cria uma nova empresa com os dados fornecidos.
     *
     * @param array $data
     * @return EmpresaEloquentModel
     */
    public function create(array $data): EmpresaEloquentModel;
}
