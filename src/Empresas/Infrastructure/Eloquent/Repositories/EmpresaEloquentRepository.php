<?php

namespace Src\Empresas\Infrastructure\Eloquent\Repositories;

use Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;

class EmpresaEloquentRepository implements EmpresaRepository
{
    public function findByCnpj(string $cnpj): ?EmpresaEloquentModel
    {
        return EmpresaEloquentModel::where('cnpj', $cnpj)->first();
    }

    public function create(array $data): EmpresaEloquentModel
    {
        return EmpresaEloquentModel::create($data);
    }
}
