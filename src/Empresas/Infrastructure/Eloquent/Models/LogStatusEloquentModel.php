<?php

namespace Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LogStatusEloquentModel
 *
 * @package Src\Empresas\Infrastructure\Eloquent\Models
 */
class LogStatusEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'log_status';

    /**
     * Indicates if the model should manage timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    /**
     * Relacionamento com os logs de importação.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function importLogs()
    {
        return $this->hasMany(EmpresaCnpjImportLogEloquentModel::class, 'log_status_id', 'id');
    }
}
