<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('endereco_estados', function (
            Blueprint $table
        ) {
            $table
                ->tinyIncrements('id');
            $table
                ->string('estado', 100)
                ->unique();
            $table
                ->char('uf', 2)
                ->unique();
        });

        Schema::create('enderecos', function (
            Blueprint $table
        ) {
            $table
                ->id()
                ->comment('Chave primária identity do endereço');

            $table
                ->string('cep', 10)
                ->unique()
                ->comment('CEP no formato 00000-000');

            $table
                ->unsignedTinyInteger('estado_id')
                ->comment('Sigla do estado (UF)');

            $table
                ->string('cidade', 100)
                ->comment('Nome da cidade');

            $table
                ->string('bairro', 100)
                ->comment('Nome do bairro');

            $table
                ->string('logradouro', 255)
                ->comment('Nome completo do logradouro');

            // Timestamps
            $table->timestamps();

            // Define as constraints.
            $table
                ->foreign('estado_id')
                ->references('id')
                ->on('endereco_estados');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
