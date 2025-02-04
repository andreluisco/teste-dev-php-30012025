<?php

namespace Src\Endereco\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Endereco\Domain\Contracts\Repositories\EnderecoEstadoRepository;
use Src\Endereco\Domain\Contracts\Repositories\EnderecoRepository;
use Src\Endereco\Infrastructure\Eloquent\Repositories\EnderecoEloquentRepository;
use Src\Endereco\Infrastructure\Eloquent\Repositories\EnderecoEstadoEloquentRepository;

class EnderecoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EnderecoRepository::class, EnderecoEloquentRepository::class);
        $this->app->bind(EnderecoEstadoRepository::class, EnderecoEstadoEloquentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
