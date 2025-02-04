<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Repositories\CnpjImportEloquentRepository;

/**
 * Testes para o repositório de importação de CNPJ (CnpjImportEloquentRepository).
 *
 * Esses testes verificam se os métodos responsáveis por criar e atualizar os logs de importação
 * funcionam conforme esperado. Aqui, de forma simples e humanizada, validamos:
 * - A criação ou recuperação de um log com status "pending".
 * - A obtenção de um status pelo nome.
 * - A marcação de um log como "success", "pending" e "failed".
 * - O incremento do número de tentativas.
 *
 * Cada teste foi escrito para ser claro e de fácil manutenção.
 */

/**
 * Testa se o método findOrCreateLog retorna um log com status "pending" para o CNPJ informado.
 *
 * @return void
 */
it('cria ou recupera um log com status pending para um CNPJ', function () {
    $repo = new CnpjImportEloquentRepository();
    $cnpj = '19131243000197';

    // Tenta criar ou recuperar o log de importação
    $log = $repo->findOrCreateLog($cnpj);

    expect($log)->toBeInstanceOf(EmpresaCnpjImportLogEloquentModel::class);
    expect($log->cnpj)->toEqual($cnpj);

    // Verifica se o status associado é "pending"
    $status = LogStatusEloquentModel::find($log->log_status_id);
    expect($status->status)->toEqual('pending');
});

/**
 * Testa se o método getStatusByName retorna corretamente um status baseado no nome.
 *
 * @return void
 */
it('retorna o status correto ao buscar por nome', function () {
    $repo = new CnpjImportEloquentRepository();

    // Ao buscar o status "success", ele deve existir ou ser criado
    $status = $repo->getStatusByName('success');

    expect($status)->toBeInstanceOf(LogStatusEloquentModel::class);
    expect($status->status)->toEqual('success');
});

/**
 * Testa se o método markAsSuccess atualiza o log para o status "success" e limpa a mensagem de erro.
 *
 * @return void
 */
it('marca um log como success', function () {
    $repo = new CnpjImportEloquentRepository();
    $cnpj = '19131243000197';

    // Cria ou recupera o log com status "pending"
    $log = $repo->findOrCreateLog($cnpj);

    // Atualiza o log para "success"
    $repo->markAsSuccess($log);
    $log->refresh();

    $status = LogStatusEloquentModel::find($log->log_status_id);
    expect($status->status)->toEqual('success');
    expect($log->error_message)->toBeNull();
});

/**
 * Testa se o método markAsPending atualiza o log para o status "pending" e limpa a mensagem de erro.
 *
 * @return void
 */
it('marca um log como pending', function () {
    $repo = new CnpjImportEloquentRepository();
    $cnpj = '19131243000197';

    // Cria ou recupera o log e marca como "failed" para simular uma alteração
    $log = $repo->findOrCreateLog($cnpj);
    $repo->markAsFailed($log, 'Erro teste');

    // Agora, reverte o status para "pending"
    $repo->markAsPending($log);
    $log->refresh();

    $status = LogStatusEloquentModel::find($log->log_status_id);
    expect($status->status)->toEqual('pending');
    expect($log->error_message)->toBeNull();
});

/**
 * Testa se o método markAsFailed atualiza o log para o status "failed" e salva a mensagem de erro.
 *
 * @return void
 */
it('marca um log como failed com mensagem de erro', function () {
    $repo = new CnpjImportEloquentRepository();
    $cnpj = '19131243000197';

    $log = $repo->findOrCreateLog($cnpj);
    $errorMsg = 'Falha ao conectar com a API';

    // Marca o log como failed com a mensagem de erro
    $repo->markAsFailed($log, $errorMsg);
    $log->refresh();

    $status = LogStatusEloquentModel::find($log->log_status_id);
    expect($status->status)->toEqual('failed');
    expect($log->error_message)->toEqual($errorMsg);
});

/**
 * Testa se o método incrementAttempts incrementa corretamente o número de tentativas do log.
 *
 * @return void
 */
it('incrementa o número de tentativas de um log', function () {
    $repo = new CnpjImportEloquentRepository();
    $cnpj = '19131243000197';

    $log = $repo->findOrCreateLog($cnpj);
    $initialAttempts = $log->attempts;

    // Incrementa as tentativas
    $repo->incrementAttempts($log);
    $log->refresh();

    expect($log->attempts)->toEqual($initialAttempts + 1);
});
