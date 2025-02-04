<?php

namespace Src\Endereco\Presentation\Api\Controllers;

use Illuminate\Http\Request;
use Src\Common\Presentation\Http\Controllers\BaseController;
use Src\Endereco\Application\Services\EnderecoEstadoService;
use Src\Endereco\Application\Services\EnderecoService;

/**
 * Class EnderecoController
 *
 * Controller para gerenciar os endpoints de Endereço.
 * - O método `estados` retorna a lista de estados.
 * - O método `store` cria um novo endereço.
 *
 * @package Src\Endereco\Presentation\Api\Controllers
 */
class EnderecoController extends BaseController
{
    protected EnderecoEstadoService $estadoService;
    protected EnderecoService $enderecoService;

    public function __construct(
        EnderecoEstadoService $estadoService,
        EnderecoService $enderecoService
    ) {
        $this->estadoService   = $estadoService;
        $this->enderecoService = $enderecoService;
    }

    /**
     * Retorna a lista de estados cadastrados.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function estados()
    {
        $estados = $this->estadoService->getAllEstados();
        return $this->sendResponse($estados, 'Estados recuperados com sucesso.');
    }

    /**
     * Cria um novo endereço.
     *
     * Recebe os dados do endereço (CEP, estado, cidade, bairro e logradouro) e cria o registro.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validação básica – considere criar um FormRequest para uma validação mais robusta
        $data = $request->validate([
            'cep'        => 'required|string|max:10',
            'estado_id'  => 'required|integer|exists:endereco_estados,id',
            'cidade'     => 'required|string|max:100',
            'bairro'     => 'required|string|max:100',
            'logradouro' => 'required|string|max:255',
        ]);

        $endereco = $this->enderecoService->createEndereco($data);
        return $this->sendResponse($endereco, 'Endereço criado com sucesso.', 201);
    }
}
