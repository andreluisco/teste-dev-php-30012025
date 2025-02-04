<?php

use App\Providers\AppServiceProvider;
use Src\Common\Infrastructure\Laravel\Providers\CommonServiceProvider;
use Src\Empresas\Application\Providers\EmpresaServiceProvider;
use Src\Endereco\Application\Providers\EnderecoServiceProvider;
use Src\Fornecedores\Application\Providers\FornecedorServiceProvider;

return [
    AppServiceProvider::class,
    CommonServiceProvider::class,


    // Customs Service Provider
    EnderecoServiceProvider::class,
    FornecedorServiceProvider::class,
    EmpresaServiceProvider::class
];
