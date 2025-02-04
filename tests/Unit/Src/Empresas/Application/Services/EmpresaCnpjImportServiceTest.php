<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Empresas\Application\Services\EmpresaCnpjImportService;
use Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Mockery;
use Mockery\MockInterface;

/**
 * Testa a importação de empresa via CNPJ com sucesso.
 */
it('importa uma empresa via CNPJ com sucesso', function () {
    $cnpj = '19131243000197';

    // Simula a resposta da BrasilAPI
    Http::fake([
        '*' => Http::response([
            'cnpj' => $cnpj,
            'razao_social' => 'Empresa Teste LTDA',
            'nome_fantasia' => 'Teste',
            'descricao_situacao_cadastral' => 'Ativa',
            'data_inicio_atividade' => '2020-01-01',
            'descricao_porte' => 'Pequena',
        ], 200)
    ]);

    // Cria um mock do repositório de Empresa
    $empresaMock = Mockery::mock(\Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository::class);

    $empresaMock->shouldReceive('findByCnpj')
                ->with($cnpj)
                ->andReturn(null);

    $empresaMock->shouldReceive('create')
                ->once()
                ->with(Mockery::on(function ($data) use ($cnpj) {
                    return $data['cnpj'] === $cnpj &&
                        $data['razao_social'] === 'Empresa Teste LTDA';
                }))
                ->andReturn(new EmpresaEloquentModel([
                    'cnpj' => $cnpj,
                    'razao_social' => 'Empresa Teste LTDA',
                    'nome_fantasia' => 'Teste',
                    'situacao_cadastral' => 'Ativa',
                    'data_inicio_atividade' => '2020-01-01',
                    'porte' => 'Pequena',
                ]));

    $service = new EmpresaCnpjImportService($empresaMock);

    $result = $service->importEmpresaByCnpj($cnpj);

    expect($result)->toBeInstanceOf(EmpresaEloquentModel::class);

    // Verifica se o log foi criado e atualizado para 'success'
    $log = EmpresaCnpjImportLogEloquentModel::where('cnpj', $cnpj)->first();
    expect($log)->not->toBeNull();
    expect($log->logStatus->status)->toEqual('success');
});

/**
 * Testa a falha na importação quando a BrasilAPI retorna erro.
 */
it('falha ao importar empresa quando a BrasilAPI retorna erro', function () {
    $cnpj = '19131243000197';

    // Simula uma falha na resposta da BrasilAPI
    Http::fake([
        '*' => Http::response('Erro', 500)
    ]);

    $empresaMock = Mockery::mock(\Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository::class);
    $empresaMock->shouldReceive('findByCnpj')
                ->with($cnpj)
                ->andReturn(null);

    $service = new EmpresaCnpjImportService($empresaMock);

    $result = $service->importEmpresaByCnpj($cnpj);

    expect($result)->toBeFalse();

    $log = EmpresaCnpjImportLogEloquentModel::where('cnpj', $cnpj)->first();
    expect($log)->not->toBeNull();
    expect($log->logStatus->status)->toEqual('failed');
    expect($log->attempts)->toEqual(1);
});
