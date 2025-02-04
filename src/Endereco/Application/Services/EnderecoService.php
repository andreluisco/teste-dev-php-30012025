<?php

namespace Src\Endereco\Application\Services;

use Src\Endereco\Domain\Contracts\Repositories\EnderecoRepository;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;

/**
 * Class EnderecoService
 *
 * Serviço responsável por orquestrar a criação de novos endereços.
 *
 * @package Src\Endereco\Application\Services
 */
class EnderecoService
{
    protected EnderecoRepository $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    /**
     * Cria um novo endereço com os dados informados.
     *
     * @param array $data
     * @return EnderecoEloquentModel
     */
    public function createEndereco(array $data): EnderecoEloquentModel
    {
        return $this->enderecoRepository->create($data);
    }
}
