<?php

namespace Src\Empresas\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class EmpresaEloquentModel
 *
 * This Eloquent model represents the "empresas" table in the database,
 * which stores information about companies.
 *
 * It also defines the many-to-many relationship with CNAEs through the pivot table "empresa_cnaes".
 *
 * @package Src\Empresas\Infrastructure\Eloquent\Models
 */
class EmpresaEloquentModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'situacao_cadastral',
        'data_inicio_atividade',
        'porte',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_inicio_atividade' => 'date',
    ];

    /**
     * Get the CNAEs associated with the company.
     *
     * This defines a many-to-many relationship between Empresa and CNAE models via the pivot table "empresa_cnaes".
     *
     * @return BelongsToMany
     */
    public function cnaes(): BelongsToMany
    {
        return $this->belongsToMany(
            CnaeEloquentModel::class,
            'empresa_cnaes',
            'empresa_id',
            'cnae_id'
        )->using(EmpresaCnaesEloquenModel::class);
    }
}
