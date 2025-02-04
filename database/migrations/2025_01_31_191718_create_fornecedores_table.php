<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        /**
         * DOCUMENTO TIPOS
         */
        Schema::create('documento_tipos', function (
            Blueprint $table
        ) {
            $table
                ->smallIncrements('id')
                ->comment('Chave primária do documento tipo');

            // Tipo do documento (CPF, CNPJ, etc.)
            $table
                ->string('tipo', 50)
                ->comment('Tipo do documento');
        });

        /**
         * FORNECEDORES
         */
        Schema::create('fornecedores', function (
            Blueprint $table
        ) {
            $table->id()
                  ->comment('Chave primária identity do fornecedor');

            // Nome do fornecedor.
            $table->string('nome', 255)
                  ->comment('Nome do fornecedor');

            // Chave estrangeira para o tipo de documento.
            $table
                ->unsignedSmallInteger('documento_tipo_id')
                ->comment('Chave estrangeira referenciando a tabela documento_tipos');

            // Número do documento (ex.: CPF ou CNPJ).
            $table
                ->string('documento_numero', 14)
                ->comment('Número do documento do fornecedor');

            // Chave estrangeira para o endereço. Note que although the original SQL specified a UUID,
            // we use foreignId() here to match the identity column in the enderecos table.
            $table
                ->foreignId('endereco_id')
                ->comment('Chave estrangeira referenciando a tabela enderecos');

            // Número e complemento do endereço.
            $table
                ->string('endereco_numero', 10)
                ->comment('Número do endereço');

            $table
                ->string('endereco_complemento', 255)
                ->nullable()
                ->comment('Complemento do endereço');

            // Timestamps
            $table->timestamps();

            // Define as constraints.
            $table->foreign('documento_tipo_id')
                  ->references('id')
                  ->on('documento_tipos')
                  ->onDelete('cascade');

            $table->foreign('endereco_id')
                  ->references('id')
                  ->on('enderecos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('documento_tipos');
    }
};
