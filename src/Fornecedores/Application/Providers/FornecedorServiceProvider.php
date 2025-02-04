<?php

namespace Src\Fornecedores\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Fornecedores\Domain\Contracts\Repositories\FornecedorRepository;
use Src\Fornecedores\Infrastructure\Eloquent\Repositories\FornecedorEloquentRepository;

class FornecedorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FornecedorRepository::class, FornecedorEloquentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
