<?php

use Illuminate\Support\Facades\Route;
use Src\Endereco\Presentation\Api\Controllers\EnderecoController;

Route::prefix('enderecos')->group(function () {
    // Endpoint para listar os estados
    Route::get('estados', [EnderecoController::class, 'estados']);

    // Endpoint para criar um novo endereço
    Route::post('/', [EnderecoController::class, 'store']);
});
