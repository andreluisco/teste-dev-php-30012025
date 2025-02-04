<?php

namespace Src\Empresas\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Empresas\Domain\Contracts\Repositories\CnpjImportRepository;
use Src\Empresas\Domain\Contracts\Repositories\EmpresaRepository;
use Src\Empresas\Infrastructure\Eloquent\Repositories\CnpjImportEloquentRepository;
use Src\Empresas\Infrastructure\Eloquent\Repositories\EmpresaEloquentRepository;

class EmpresaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CnpjImportRepository::class, CnpjImportEloquentRepository::class);
        $this->app->bind(EmpresaRepository::class, EmpresaEloquentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
