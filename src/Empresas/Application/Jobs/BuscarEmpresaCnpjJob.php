<?php

namespace Src\Empresas\Application\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Src\Empresas\Application\Services\EmpresaCnpjImportService;

/**
 * Job responsável por buscar os dados de uma empresa via CNPJ
 * utilizando a BrasilAPI e salvar as informações no sistema.
 *
 * O job será enviado para a fila do RabbitMQ e tentará executar
 * até 5 vezes caso ocorra alguma falha.
 */
class BuscarEmpresaCnpjJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Número máximo de tentativas para esse job.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * O CNPJ que será buscado.
     *
     * @var string
     */
    protected string $cnpj;

    /**
     * Construtor do job.
     *
     * @param string $cnpj O CNPJ a ser buscado.
     */
    public function __construct(string $cnpj)
    {
        $this->cnpj = $cnpj;
        Log::info("CNPJ registrado para busca: {$this->cnpj}");
    }

    /**
     * Executa o job.
     *
     * Injeta o serviço de importação, chama a função de importação para o CNPJ
     * e lança uma exceção caso a operação falhe, acionando o mecanismo de retry.
     *
     * @param EmpresaCnpjImportService $importService
     *
     * @return void
     *
     * @throws Exception Se a importação falhar.
     */
    public function handle(EmpresaCnpjImportService $importService): void
    {
        Log::info("Executando job para CNPJ: {$this->cnpj}");

        $result = $importService->importEmpresaByCnpj($this->cnpj);

        if (!$result) {
            // Lança exceção para acionar a lógica de retry do Laravel.
            Log::error("Falha ao importar empresa para CNPJ: {$this->cnpj}");
            throw new Exception("Falha ao importar a empresa com CNPJ: {$this->cnpj}");
        }

        // Se der certo, você pode registrar o sucesso se necessário.
        Log::info("Empresa importada com sucesso para CNPJ: {$this->cnpj}");
    }

    /**
     * Lida com a falha do job após esgotadas todas as tentativas.
     *
     * Aqui você pode realizar ações como notificar administradores, registrar
     * em logs de falha, etc.
     *
     * @param Exception $exception A exceção que causou a falha.
     *
     * @return void
     */
    public function failed(Exception $exception): void
    {
        Log::error("Job BuscarEmpresaCnpjJob falhou para CNPJ: {$this->cnpj}. Erro: " . $exception->getMessage());
        // Aqui você pode, por exemplo, notificar via email ou registrar em uma tabela de falhas.
    }
}
