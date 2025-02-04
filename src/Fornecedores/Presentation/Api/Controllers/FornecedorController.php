<?php

namespace Src\Fornecedores\Presentation\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Common\Presentation\Http\Controllers\BaseController;
use Src\Fornecedores\Application\Services\FornecedorService;
use Src\Fornecedores\Presentation\Api\Requests\CreateFornecedorRequest;
use Src\Fornecedores\Presentation\Api\Requests\UpdateFornecedorRequest;
use Src\Fornecedores\Presentation\Api\Resources\FornecedorResource;

class FornecedorController extends BaseController
{
    protected FornecedorService $service;

    public function __construct(FornecedorService $service)
    {
        $this->service = $service;
    }

    // Listar fornecedores (with optional filters)
    public function index(Request $request)
    {
        $filters = $request->only([
            'nome',
            'documento_numero'
        ]);

        $fornecedores = $this->service->listFornecedores($filters);

        return $this->sendResponse(
            FornecedorResource::collection($fornecedores),
            'Fornecedores retrieved successfully.'
        );
    }

    // Criar fornecedor
    public function store(CreateFornecedorRequest $request)
    {
        $data       = $request->validated();
        $fornecedor = $this->service->createFornecedor($data);

        return $this->sendResponse(
            new FornecedorResource($fornecedor),
            'Fornecedor created successfully.',
            Response::HTTP_CREATED
        );
    }

    // Exibir detalhes de um fornecedor
    public function show($id)
    {
        $fornecedor = $this->service->getFornecedor($id);

        if (!$fornecedor) {
            return $this->sendError(
                'Fornecedor not found',
                'The requested fornecedor does not exist.',
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->sendResponse(
            new FornecedorResource($fornecedor),
            'Fornecedor retrieved successfully.'
        );
    }

    // Atualizar fornecedor
    public function update(UpdateFornecedorRequest $request, $id)
    {
        $data       = $request->validated();
        $fornecedor = $this->service->updateFornecedor($id, $data);

        if (!$fornecedor) {
            return $this->sendError(
                'Fornecedor not found',
                'Unable to update fornecedor, not found.',
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->sendResponse(
            new FornecedorResource($fornecedor),
            'Fornecedor updated successfully.'
        );
    }

    // Excluir fornecedor
    public function destroy($id)
    {
        $deleted = $this->service->deleteFornecedor($id);

        if (!$deleted) {
            return $this->sendError(
                'Fornecedor not found',
                'Unable to delete fornecedor, not found.',
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->sendResponse(
            null,
            'Fornecedor deleted successfully.'
        );
    }
}
