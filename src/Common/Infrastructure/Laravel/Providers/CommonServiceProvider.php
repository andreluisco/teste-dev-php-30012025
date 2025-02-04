<?php

namespace Src\Common\Infrastructure\Laravel\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->map();
    }

    public function map()
    {
        $this->mapApiRoutes();
    }

    /**
     * Mapeia as rotas da aplicação
     *
     * @return void
     */
    public function mapApiRoutes()
    {
        $this->routes(function () {
            Route::middleware('api')
                 ->prefix('api')
                 ->group(function () {
                     require base_path('src/Fornecedores/Presentation/Api/routes.php');
                     require base_path('src/Endereco/Presentation/Api/routes.php');
                 });
        });
    }
}

