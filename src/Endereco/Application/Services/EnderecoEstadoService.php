<?php

namespace Src\Endereco\Application\Services;

use Illuminate\Support\Collection;
use Src\Endereco\Domain\Contracts\Repositories\EnderecoEstadoRepository;

/**
 * Class EnderecoEstadoService
 *
 * Serviço responsável por orquestrar a lógica de recuperação dos estados.
 *
 * @package Src\Endereco\Application\Services
 */
class EnderecoEstadoService
{
    protected EnderecoEstadoRepository $enderecoEstadoRepository;

    public function __construct(EnderecoEstadoRepository $enderecoEstadoRepository)
    {
        $this->enderecoEstadoRepository = $enderecoEstadoRepository;
    }

    /**
     * Recupera todos os estados.
     *
     * @return Collection
     */
    public function getAllEstados(): Collection
    {
        return $this->enderecoEstadoRepository->getAll();
    }
}
