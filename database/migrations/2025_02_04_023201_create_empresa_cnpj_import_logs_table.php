<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * LOGS STATUS
         */
        Schema::create('log_status', function (
            Blueprint $table
        ) {
            $table
                ->smallIncrements('id');

            // Tipo do documento (CPF, CNPJ, etc.)
            $table
                ->string('status', 50)
                ->comment('Descrição do status');
        });

        Schema::create('empresa_cnpj_import_logs', function (
            Blueprint $table
        ) {
            $table->id();
            $table->string('cnpj', 20)
                  ->unique();

            $table
                ->unsignedSmallInteger('log_status_id')
                ->comment('Valores possíveis: pending, success, failed');


            $table->unsignedSmallInteger('attempts')
                  ->default(0);

            $table->text('error_message')
                  ->nullable();

            $table->timestamps();

            // Define as constraints.
            $table->foreign('log_status_id')
                  ->references('id')
                  ->on('log_status')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_cnpj_import_logs');
        Schema::dropIfExists('log_status');
    }
};
