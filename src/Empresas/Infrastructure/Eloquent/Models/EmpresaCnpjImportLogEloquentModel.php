<?php

namespace Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpresaCnpjImportLogEloquentModel
 *
 * Modelo Eloquent que registra o processo de importação dos dados da empresa via CNPJ,
 * obtidos da BrasilAPI.
 *
 * @package Src\Empresas\Infrastructure\Eloquent\Models
 */
class EmpresaCnpjImportLogEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresa_cnpj_import_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'log_status_id',
        'attempts',
        'error_message',
    ];

    /**
     * Relacionamento com o status do log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logStatus()
    {
        return $this->belongsTo(LogStatusEloquentModel::class, 'log_status_id', 'id');
    }
}
