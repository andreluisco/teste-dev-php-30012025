<?php

use Illuminate\Support\Facades\Route;
use Src\Fornecedores\Presentation\Api\Controllers\FornecedorController;

Route::prefix('fornecedores')->group(function () {
    Route::get('/', [FornecedorController::class, 'index']);
    Route::post('/', [FornecedorController::class, 'store']);
    Route::get('/{id}', [FornecedorController::class, 'show']);
    Route::put('/{id}', [FornecedorController::class, 'update']);
    Route::delete('/{id}', [FornecedorController::class, 'destroy']);
});
