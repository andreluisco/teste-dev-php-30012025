<?php

namespace Src\Fornecedores\Application\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Src\Fornecedores\Domain\Contracts\Repositories\FornecedorRepository;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

class FornecedorService
{
    protected FornecedorRepository $repository;

    public function __construct(FornecedorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createFornecedor(array $data): FornecedorEloquentModel
    {
        return $this->repository->create($data);
    }

    public function updateFornecedor(
        int $id,
        array $data
    ): ?FornecedorEloquentModel {
        return $this->repository->update($id, $data);
    }

    public function deleteFornecedor(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getFornecedor(int $id): ?FornecedorEloquentModel
    {
        return $this->repository->find($id);
    }

    public function listFornecedores(
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        return $this->repository->list($filters, $perPage);
    }

    public function findFornecedorByDocumentoNumero(string $documentoNumero): ?FornecedorEloquentModel
    {
        return $this->repository->findByDocumentoNumero($documentoNumero);
    }
}
