<?php

namespace Src\Endereco\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class EnderecoEloquentModel
 *
 * This Eloquent model represents the "enderecos" table in the database.
 *
 * @package Src\Endereco\Infrastructure\Eloquent\Models
 */
class EnderecoEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enderecos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cep',
        'estado_id',
        'cidade',
        'bairro',
        'logradouro',
    ];

    /**
     * Get the estado (state) that this endereço belongs to.
     *
     * @return BelongsTo
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(EnderecoEstadoEloquentModel::class, 'estado_id', 'id');
    }
}
