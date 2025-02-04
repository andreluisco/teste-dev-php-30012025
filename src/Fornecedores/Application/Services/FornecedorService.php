<?php

namespace Src\Fornecedores\Application\Services;

use LaravelLegends\PtBrValidator\Rules\Cnpj;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Src\Empresas\Application\Jobs\BuscarEmpresaCnpjJob;
use Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository;
use Src\Fornecedores\Domain\Contracts\Repositories\FornecedorRepository;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

class FornecedorService
{
    protected FornecedorRepository $repository;
    protected EmpresaRepository $empresaRepository;

    public function __construct(FornecedorRepository $repository, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
    }

    public function createFornecedor(array $data): FornecedorEloquentModel
    {
        // Verifica se o documento informado é um CNPJ válido
        $cnpjRule = new Cnpj;
        if ($cnpjRule->passes('documento_numero', $data['documento_numero'])) {
            // Se for um CNPJ válido, busca a empresa associada
            $empresa = $this->empresaRepository->findByCnpj($data['documento_numero']);
            if (!$empresa) {
                // Se a empresa não existe, despacha o job para buscar os dados da empresa
                BuscarEmpresaCnpjJob::dispatch($data['documento_numero']);
            }
        }

        // Cria o registro do fornecedor normalmente
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
