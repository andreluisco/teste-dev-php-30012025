<?php

namespace Src\Empresas\Application\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Src\Empresas\Domain\Contracts\Repositories\CnpjImportRepository;
use Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;

class EmpresaCnpjImportService
{
    protected EmpresaRepository $empresaRepository;
    private CnpjImportRepository $cnpjImportRepository;

    protected int $maxAttempts = 5;

    public function __construct(
        EmpresaRepository $empresaRepository,
        CnpjImportRepository $cnpjImportRepository
    ) {
        $this->empresaRepository    = $empresaRepository;
        $this->cnpjImportRepository = $cnpjImportRepository;
    }

    /**
     * Tenta importar os dados de uma empresa a partir do CNPJ.
     *
     * Caso a empresa já exista, retorna a instância. Se não existir,
     * faz a chamada à BrasilAPI, mapeia os dados necessários e cria a empresa.
     * Também registra o processo na tabela de log.
     *
     * @param string $cnpj
     *
     * @return mixed EmpresaEloquentModel ou false em caso de falha
     */
    public function importEmpresaByCnpj(string $cnpj)
    {
        Log::info("Iniciando importação para CNPJ: {$cnpj}");
        // Verifica se a empresa já existe
        $empresa = $this->empresaRepository->findByCnpj($cnpj);

        if ($empresa) {
            Log::info("Empresa já existe no sistema para CNPJ: {$cnpj}");
            return $empresa;
        }

        // Cria ou atualiza o log de importação
        Log::info("Criando/atualizando log de importação para CNPJ: {$cnpj}");
        $log = $this->cnpjImportRepository->findOrCreateLog($cnpj);
        $this->cnpjImportRepository->incrementAttempts($log);

        // Se já atingiu mais de 5 tentativas, interrompe
        if ($log->attempts > $this->maxAttempts) {
            Log::warning("Número máximo de tentativas atingido para CNPJ: {$cnpj}");
            $this->cnpjImportRepository->markAsFailed($log, 'Número máximo de tentativas atingido');
            return false;
        }

        // Busca os dados na BrasilAPI
        $response = Http::get(
            config('services.brasilapi.cnpj') . '/' . $cnpj
        );

        if ($response->failed()) {
            Log::error("Falha na requisição à BrasilAPI para CNPJ: {$cnpj}. Resposta: " . $response->body());
            $this->cnpjImportRepository->markAsFailed($log, $response->body());
            return false;
        }

        Log::info("Dados recebidos da BrasilAPI para CNPJ: {$cnpj}");
        return $this->createEmpresaFromApiResponse($log, $response->json());
    }

    private function createEmpresaFromApiResponse(
        $log,
        array $data
    ): EmpresaEloquentModel|bool {
        try {
            Log::info("Criando empresa no banco de dados para CNPJ: {$data['cnpj']}");

            $empresa = $this->empresaRepository->create([
                'cnpj'                  => $data['cnpj'],
                'razao_social'          => $data['razao_social'],
                'nome_fantasia'         => $data['nome_fantasia'] ?? null,
                'situacao_cadastral'    => $data['descricao_situacao_cadastral'],
                'data_inicio_atividade' => $data['data_inicio_atividade'],
                'porte'                 => $data['descricao_porte']
            ]);

            Log::info("Empresa criada com sucesso para CNPJ: {$data['cnpj']}");
            $this->cnpjImportRepository->markAsSuccess($log);
            return $empresa;

        }
        catch (\Exception $e) {
            Log::error("Erro ao criar empresa para CNPJ: {$data['cnpj']}. Erro: " . $e->getMessage());
            $this->cnpjImportRepository->markAsFailed($log, $e->getMessage());
            return false;
        }
    }
}
