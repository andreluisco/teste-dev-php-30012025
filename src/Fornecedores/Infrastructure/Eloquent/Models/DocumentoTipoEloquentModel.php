<?php

namespace Src\Fornecedores\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DocumentoTipoEloquentModel
 *
 * This Eloquent model represents the "documento_tipos" table in the database.
 *
 * @package Src\Fornecedores\Infrastructure\Eloquent\Models
 */
class DocumentoTipoEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'documento_tipos';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key type is integer (small integer).
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
    ];

    /**
     * Get the fornecedores that use this document type.
     *
     * @return HasMany
     */
    public function fornecedores(): HasMany
    {
        return $this->hasMany(FornecedorEloquentModel::class, 'documento_tipo_id', 'id');
    }
}
