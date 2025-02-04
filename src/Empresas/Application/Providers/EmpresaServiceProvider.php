<?php

namespace Src\Empresas\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Empresas\Domain\Contracts\Repositories\CnpjImportRepository;
use Src\Empresas\Infrastructure\Eloquent\Repositories\CnpjImportEloquentRepository;

class EmpresaServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CnpjImportRepository::class, CnpjImportEloquentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
