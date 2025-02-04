<?php

namespace Src\Fornecedores\Domain\Contracts\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

interface FornecedorRepository
{
    /**
     * Cria um novo fornecedor no banco de dados
     *
     * @param array $data Dados do fornecedor a ser criado
     *
     * @return FornecedorEloquentModel Instância do fornecedor criado
     */
    public function create(array $data): FornecedorEloquentModel;
    /**
     * Atualiza os dados de um fornecedor existente
     *
     * @param int   $id   ID do fornecedor a ser atualizado
     * @param array $data Novos dados do fornecedor
     *
     * @return FornecedorEloquentModel|null Instância atualizada ou null se não encontrado
     */
    public function update(
        int $id,
        array $data
    ): ?FornecedorEloquentModel;
    /**
     * Remove um fornecedor do sistema
     *
     * @param int $id ID do fornecedor a ser removido
     *
     * @return bool True se a remoção foi bem sucedida, False caso contrário
     */
    public function delete(int $id): bool;
    /**
     * Busca um fornecedor pelo seu ID
     *
     * @param int $id ID do fornecedor
     *
     * @return FornecedorEloquentModel|null Instância do fornecedor ou null se não encontrado
     */
    public function find(int $id): ?FornecedorEloquentModel;
    /**
     * Lista fornecedores com paginação e filtros
     *
     * @param array $filters Filtros de pesquisa (nome, documento_numero)
     * @param int   $perPage Número de itens por página
     *
     * @return LengthAwarePaginator Resultados paginados
     */
    public function list(
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator;

    /**
     * Busca um fornecedor pelo número do documento
     *
     * @param string $documentoNumero Número completo do documento
     *
     * @return FornecedorEloquentModel|null Instância do fornecedor ou null se não encontrado
     */
    public function findByDocumentoNumero(string $documentoNumero): ?FornecedorEloquentModel;
}
