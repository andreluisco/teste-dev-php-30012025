<?php

namespace Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class QsaEloquentModel
 *
 * This Eloquent model represents the "qsa" table in the database,
 * which stores information about corporate shareholders.
 *
 * @package Src\Qsa\Infrastructure\Eloquent\Models
 */
class QsaEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qsa';

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the primary key is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
        'id',
        'empresa_id',
        'nome_socio',
        'cnpj_cpf_socio',
        'qualificacao_socio',
        'data_entrada_sociedade',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                     => 'string',
        'data_entrada_sociedade' => 'date',
    ];

    /**
     * Define the relationship with the Empresa model.
     *
     * @return BelongsTo
     */
    public function empresa(): BelongsTo
    {
        return $this->belongsTo(EmpresaCnaesEloquenModel::class, 'empresa_id');
    }
}
