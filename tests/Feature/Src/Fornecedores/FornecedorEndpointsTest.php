<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEstadoEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Models\DocumentoTipoEloquentModel;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;
use Src\Fornecedores\Infrastructure\Eloquent\Models\FornecedorEloquentModel;

uses(RefreshDatabase::class);

/**
 * Testa o cadastro de um novo fornecedor via API.
 *
 * Verifica se o endpoint POST /api/fornecedores cadastra corretamente um novo fornecedor.
 *
 * @return void
 */
it('cadastra um novo fornecedor via API', function () {
    // Cria os registros relacionados necessários usando factories
    $documentoTipo = DocumentoTipoEloquentModel::factory()->create();
    $estado        = EnderecoEstadoEloquentModel::factory()->create();
    $endereco      = EnderecoEloquentModel::factory()->create(['estado_id' => $estado->id]);

    // Gera os dados do fornecedor utilizando o fake() para criar informações dinâmicas
    $data = [
        'nome'                 => fake()->company,
        'documento_tipo_id'    => $documentoTipo->id,
        'documento_numero'     => fake()->numerify('##############'), // 14 dígitos
        'endereco_id'          => $endereco->id,
        'endereco_numero'      => fake()->numerify('###'),
        'endereco_complemento' => fake()->optional()->word(),
    ];

    // Envia os dados para o endpoint de criação
    $response = $this->postJson('/api/fornecedores', $data);

    $response->assertStatus(201);
    $response->assertJsonFragment(['nome' => $data['nome']]);
});

/**
 * Testa a listagem de fornecedores via API.
 *
 * Este teste verifica se o endpoint GET /api/fornecedores retorna uma resposta JSON
 * com a estrutura correta. Atualmente, o BaseController retorna um array com as chaves
 * "success", "data" e "message". Aqui, esperamos que "data" seja um array de fornecedores.
 *
 * @return void
 */
it('lista os fornecedores via API', function () {
    // Cria 5 fornecedores usando factories
    FornecedorEloquentModel::factory()->count(5)->create();

    // Envia requisição GET para o endpoint de listagem
    $response = $this->getJson('/api/fornecedores');

    // Verifica se o status HTTP é 200 (OK)
    $response->assertStatus(200);

    // Verifica se a resposta possui as chaves "success", "data" e "message"
    $response->assertJsonStructure([
        'success',
        'data',
        'message',
    ]);

    // Opcional: Verifica se "data" é um array
    $data = $response->json('data');
    expect($data)->toBeArray();
});

/**
 * Testa a exibição dos detalhes de um fornecedor via API.
 *
 * Verifica se o endpoint GET /api/fornecedores/{id} retorna os dados do fornecedor
 * solicitado.
 *
 * @return void
 */
it('exibe os detalhes de um fornecedor via API', function () {
    $fornecedor = FornecedorEloquentModel::factory()->create();

    $response = $this->getJson("/api/fornecedores/{$fornecedor->id}");

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $fornecedor->id]);
});

/**
 * Testa a atualização de um fornecedor via API.
 *
 * Verifica se o endpoint PUT /api/fornecedores/{id} atualiza os dados do fornecedor
 * e retorna as informações atualizadas.
 *
 * @return void
 */
it('atualiza um fornecedor via API', function () {
    $fornecedor = FornecedorEloquentModel::factory()->create();

    // Dados de atualização gerados com fake()
    $dadosAtualizacao = [
        'nome' => fake()->company,
    ];

    $response = $this->putJson("/api/fornecedores/{$fornecedor->id}", $dadosAtualizacao);

    $response->assertStatus(200);
    $response->assertJsonFragment(['nome' => $dadosAtualizacao['nome']]);
});

/**
 * Testa a exclusão de um fornecedor via API.
 *
 * Verifica se o endpoint DELETE /api/fornecedores/{id} remove o fornecedor
 * e retorna uma mensagem de sucesso.
 *
 * @return void
 */
it('exclui um fornecedor via API', function () {
    $fornecedor = FornecedorEloquentModel::factory()->create();

    $response = $this->deleteJson("/api/fornecedores/{$fornecedor->id}");

    $response->assertStatus(200);
    $response->assertJsonFragment(['message' => 'Fornecedor deleted successfully.']);
});
