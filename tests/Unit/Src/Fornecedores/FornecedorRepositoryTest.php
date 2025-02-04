<?php

use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Repositories\FornecedorEloquentRepository;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Models\DocumentoTipoEloquentModel;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;

/**
 * Teste: Deve criar um novo fornecedor com dados válidos
 *
 * @verifica Se o fornecedor é salvo corretamente no banco de dados
 * @verifica Se os atributos principais correspondem aos dados enviados
 */
it('Salva um novo fornecedor', function () {
    $documentoTipo = DocumentoTipoEloquentModel::factory()
                                               ->create();

    $estado = EnderecoEstadoEloquentModel::factory()
                                         ->create();

    $endereco = EnderecoEloquentModel::factory()
                                     ->create(['estado_id' => $estado->id]);

    $repository = new FornecedorEloquentRepository();

    $data = [
        'nome'                 => 'Compania 001',
        'documento_tipo_id'    => $documentoTipo->id,
        'documento_numero'     => '12345678901234',
        'endereco_id'          => $endereco->id,
        'endereco_numero'      => '456',
        'endereco_complemento' => 'Floor 2',
    ];

    $fornecedor = $repository->create($data);

    expect($fornecedor)
        ->toBeInstanceOf(FornecedorEloquentModel::class)
        ->and($fornecedor->nome)
        ->toEqual($data['nome']);
});

/**
 * Teste: Deve atualizar os dados de um fornecedor existente
 *
 * @verifica Se os dados alterados são persistidos no banco
 * @verifica Se retorna null quando tenta atualizar fornecedor inexistente
 */
it('Atualiza um fornecedor existente', function () {
    $repository = new FornecedorEloquentRepository();

    // Cria fornecedor inicial
    $fornecedor = FornecedorEloquentModel::factory()->create();

    // Dados de atualização
    $novosDados = ['nome' => 'Novo Nome Fornecedor'];

    // Atualiza válida
    $updated = $repository->update($fornecedor->id, $novosDados);
    expect($updated->nome)->toBe('Novo Nome Fornecedor');

    // Tentativa de atualizar ID inexistente
    $invalidUpdate = $repository->update(9999, $novosDados);
    expect($invalidUpdate)->toBeNull();
});

/**
 * Teste: Deve remover um fornecedor do sistema
 *
 * @verifica Se o fornecedor é deletado do banco
 * @verifica Se retorna false quando tenta remover ID inexistente
 */
it('Remove um fornecedor', function () {
    $repository = new FornecedorEloquentRepository();
    $fornecedor = FornecedorEloquentModel::factory()->create();

    // Remoção válida
    $result = $repository->delete($fornecedor->id);
    expect($result)->toBeTrue();
    expect(FornecedorEloquentModel::find($fornecedor->id))->toBeNull();

    // Tentativa de remover ID inexistente
    $invalidDelete = $repository->delete(9999);
    expect($invalidDelete)->toBeFalse();
});

/**
 * Teste: Deve encontrar fornecedor pelo ID
 *
 * @verifica Se retorna a instância correta
 * @verifica Se retorna null para ID inexistente
 */
it('Busca fornecedor por ID', function () {
    $repository = new FornecedorEloquentRepository();
    $fornecedor = FornecedorEloquentModel::factory()->create();

    $found = $repository->find($fornecedor->id);
    expect($found->id)->toBe($fornecedor->id);

    $notFound = $repository->find(9999);
    expect($notFound)->toBeNull();
});

/**
 * Teste: Deve listar fornecedores com filtros e paginação
 *
 * @verifica Se retorna resultados paginados
 * @verifica Se aplica corretamente os filtros de pesquisa
 */
it('Lista fornecedores com filtros', function () {
    $repository = new FornecedorEloquentRepository();

    // Cria 3 fornecedores de teste
    FornecedorEloquentModel::factory()->count(3)->create();

    // Teste sem filtros
    $result = $repository->list();
    expect($result->total())->toBe(3);

    // Teste com filtro de nome
    $result = $repository->list(['nome' => 'Especial'], 15);
    expect($result->items())->toHaveCount(0);
});

/**
 * Teste: Deve encontrar fornecedor pelo número do documento
 *
 * @verifica Se localiza corretamente pelo documento
 * @verifica Se retorna null para documento não cadastrado
 */
it('Busca fornecedor por número do documento', function () {
    $repository = new FornecedorEloquentRepository();

    $documento = '12345678900001';
    FornecedorEloquentModel::factory()->create(['documento_numero' => $documento]);

    $found = $repository->findByDocumentoNumero($documento);
    expect($found->documento_numero)->toBe($documento);

    $notFound = $repository->findByDocumentoNumero('00000000000000');
    expect($notFound)->toBeNull();
});


