<?php

namespace Src\Fornecedores\Infrastructure\Eloquent\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Src\Fornecedores\Domain\Contracts\Repositories\FornecedorRepository;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

/**
 * Repositório Eloquent para gestão de fornecedores
 *
 * Responsável por operações de CRUD e consultas de fornecedores usando Eloquent ORM
 */
class FornecedorEloquentRepository implements FornecedorRepository
{
    /**
     * @inheritDoc
     *
     * @param array{
     *  nome?: string,
     *  documento_tipo_id?: int,
     *  documento_numero?: string,
     *  endereco_id?: int,
     *  endereco_numero?: string,
     *  endereco_complemento?: string|null
     * } $data
     */
    public function create(array $data): FornecedorEloquentModel
    {
        return FornecedorEloquentModel::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(
        int $id,
        array $data
    ): ?FornecedorEloquentModel {
        $fornecedor = FornecedorEloquentModel::find($id);
        if (!$fornecedor) {
            return null;
        }
        $fornecedor->update($data);
        return $fornecedor;
    }


    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $fornecedor = FornecedorEloquentModel::find($id);
        if (!$fornecedor) {
            return false;
        }
        return $fornecedor->delete();
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): ?FornecedorEloquentModel
    {
        return FornecedorEloquentModel::find($id);
    }

    /**
     * @inheritDoc
     */
    public function list(
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        $query = FornecedorEloquentModel::query();

        if (!empty($filters['nome'])) {
            $query->where('nome', 'like', '%' . $filters['nome'] . '%');
        }
        if (!empty($filters['documento_numero'])) {
            $query->where('documento_numero', $filters['documento_numero']);
        }
        // You can add ordering and more filtering here
        return $query->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findByDocumentoNumero(string $documentoNumero): ?FornecedorEloquentModel
    {
        return FornecedorEloquentModel::where('documento_numero', $documentoNumero)
                                      ->first();
    }
}
