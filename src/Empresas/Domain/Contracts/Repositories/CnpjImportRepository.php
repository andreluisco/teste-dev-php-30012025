<?php

namespace Src\Empresas\Domain\Contracts\Repositories;

use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;

interface CnpjImportRepository
{
    public function findOrCreateLog(string $cnpj): EmpresaCnpjImportLogEloquentModel;
    public function getStatusByName(string $status): LogStatusEloquentModel;
    public function markAsPending(EmpresaCnpjImportLogEloquentModel $log): void;
    public function markAsSuccess(EmpresaCnpjImportLogEloquentModel $log): void;
    public function markAsFailed(EmpresaCnpjImportLogEloquentModel $log, string $message): void;
    public function incrementAttempts(EmpresaCnpjImportLogEloquentModel $log): void;
}
