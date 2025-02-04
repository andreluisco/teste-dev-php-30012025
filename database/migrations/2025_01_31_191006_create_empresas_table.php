<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        /**
         * CNAES
         */
        Schema::create('cnaes', function (
            Blueprint $table
        ) {
            $table
                ->id()
                ->comment('Chave primária identity do CNAE');

            $table
                ->string('codigo', 10)
                ->unique()
                ->comment('Código único do CNAE');

            $table
                ->text('descricao')
                ->comment('Descrição detalhada do CNAE');
        });

        /**
         * EMPRESA
         */
        Schema::create('empresas', function (
            Blueprint $table
        ) {
            $table
                ->id()
                ->comment('Chave primária identity da empresa');

            $table
                ->string('cnpj', 14)
                ->unique()
                ->comment('CNPJ da empresa (14 dígitos, sem formatação)');

            $table
                ->string('razao_social', 255)
                ->comment('Razão social da empresa');

            $table
                ->string('nome_fantasia', 255)
                ->nullable()
                ->comment('Nome fantasia da empresa (opcional)');

            $table
                ->string('situacao_cadastral', 50)
                ->comment('Situação cadastral da empresa');

            $table
                ->date('data_inicio_atividade')
                ->comment('Data de início das atividades da empresa');

            $table
                ->string('porte', 50)
                ->comment('Porte da empresa (ex: MEI, EPP, Grande Porte)');

            // Timestamps
            $table->timestamps();
        });

        /**
         * QSA
         */
        Schema::create('qsa', function (
            Blueprint $table
        ) {
            $table
                ->id()
                ->comment('Chave primária identity do registro QSA');

            $table
                ->foreignId('empresa_id')
                ->comment('Chave estrangeira referenciando a tabela empresas');

            $table
                ->string('nome_socio', 255)
                ->comment('Nome completo do sócio');

            $table
                ->string('cnpj_cpf_socio', 14)
                ->nullable()
                ->comment('CNPJ ou CPF do sócio (14 dígitos, sem formatação)');

            $table
                ->string('qualificacao_socio', 255)
                ->comment('Qualificação do sócio (ex: Administrador, Diretor)');

            $table
                ->date('data_entrada_sociedade')
                ->nullable()
                ->comment('Data de entrada do sócio na sociedade');

            // Timestamps
            $table->timestamps();

            // Define the foreign key constraint
            $table
                ->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->onDelete('cascade');
        });

        /**
         * EMPRESA CNAEs
         */
        Schema::create('empresa_cnaes', function (
            Blueprint $table
        ) {
            $table
                ->foreignId('empresa_id')
                ->comment('Chave estrangeira referenciando a tabela empresas');
            $table
                ->foreignId('cnae_id')
                ->comment('Chave estrangeira referenciando a tabela cnaes');

            // Composite primary key.
            $table
                ->primary([
                    'empresa_id',
                    'cnae_id'
                ]);

            // Define foreign key constraints.
            $table
                ->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->onDelete('cascade');

            $table
                ->foreign('cnae_id')
                ->references('id')
                ->on('cnaes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresa_cnaes');
        Schema::dropIfExists('qsa');
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('cnaes');
    }
};
