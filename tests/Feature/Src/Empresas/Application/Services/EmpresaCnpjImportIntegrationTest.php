<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Empresas\Application\Services\EmpresaCnpjImportService;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Repositories\EmpresaEloquentRepository;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;

/**
 * Testa a integração completa da importação via CNPJ.
 *
 * Este teste utiliza o repositório real para criar a empresa e registra o log
 * do processo de importação.
 */
it('integra a importação de empresa via CNPJ com sucesso', function () {
    $cnpj = '19131243000197';

    // Finge a resposta da BrasilAPI
    Http::fake([
        '*' => Http::response([
            'cnpj' => $cnpj,
            'razao_social' => 'Empresa Integrada LTDA',
            'nome_fantasia' => 'Integrada',
            'descricao_situacao_cadastral' => 'Ativa',
            'data_inicio_atividade' => '2020-01-01',
            'descricao_porte' => 'Média',
        ], 200)
    ]);

    $empresaRepo = new EmpresaEloquentRepository();
    $service = new \Src\Empresas\Application\Services\EmpresaCnpjImportService($empresaRepo);

    $result = $service->importEmpresaByCnpj($cnpj);

    expect($result)->toBeInstanceOf(EmpresaEloquentModel::class);
    expect($result->cnpj)->toEqual($cnpj);

    $log = EmpresaCnpjImportLogEloquentModel::where('cnpj', $cnpj)->first();
    expect($log)->not->toBeNull();
    expect($log->logStatus->status)->toEqual('success');
});
