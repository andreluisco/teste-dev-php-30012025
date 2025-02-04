<?php

namespace Src\Endereco\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class EnderecoEstadoEloquentModel
 *
 * This Eloquent model represents the "endereco_estados" table in the database.
 *
 * @package Src\Endereco\Infrastructure\Eloquent\Models
 */
class EnderecoEstadoEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'endereco_estados';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // This table does not have timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado',
        'uf',
    ];

    /**
     * Get the enderecos associated with this estado.
     *
     * @return HasMany
     */
    public function enderecos(): HasMany
    {
        return $this->hasMany(EnderecoEloquentModel::class, 'estado_id', 'id');
    }
}
