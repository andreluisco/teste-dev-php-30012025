<?php

namespace Src\Empresas\Infrastructure\Eloquent\Repositories;

use Src\Empresas\Domain\Contracts\Repositories\CnpjImportRepository;
use Src\Empresas\Infrastructure\Eloquent\Models\EmpresaCnpjImportLogEloquentModel;
use Src\Empresas\Infrastructure\Eloquent\Models\LogStatusEloquentModel;

class CnpjImportEloquentRepository implements CnpjImportRepository
{
    public function findOrCreateLog(string $cnpj): EmpresaCnpjImportLogEloquentModel
    {
        return EmpresaCnpjImportLogEloquentModel::firstOrCreate(
            ['cnpj' => $cnpj],
            ['log_status_id' => $this->getStatusByName('pending')->id]
        );
    }

    public function getStatusByName(string $status): LogStatusEloquentModel
    {
        return LogStatusEloquentModel::firstOrCreate(
            ['status' => $status],
            ['status' => $status]
        );
    }

    public function markAsSuccess(EmpresaCnpjImportLogEloquentModel $log): void
    {
        $log->update([
            'log_status_id' => $this->getStatusByName('success')->id,
            'error_message' => null
        ]);
    }

    public function markAsPending(EmpresaCnpjImportLogEloquentModel $log): void
    {
        $log->update([
            'log_status_id' => $this->getStatusByName('pending')->id,
            'error_message' => null
        ]);
    }

    public function markAsFailed(EmpresaCnpjImportLogEloquentModel $log, string $message): void
    {
        $log->update([
            'log_status_id' => $this->getStatusByName('failed')->id,
            'error_message' => $message
        ]);
    }

    public function incrementAttempts(EmpresaCnpjImportLogEloquentModel $log): void
    {
        $log->increment('attempts');
    }
}
