<?php


namespace Src\Fornecedores\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Src\Endereco\Infrastructure\Eloquent\Models\EnderecoEloquentModel;

/**
 * Class FornecedorEloquentModel
 *
 * This Eloquent model represents the "fornecedores" table in the database.
 *
 * @package Src\Fornecedores\Infrastructure\Eloquent\Models
 */
class FornecedorEloquentModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fornecedores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'documento_tipo_id',
        'documento_numero',
        'endereco_id',
        'endereco_numero',
        'endereco_complemento',
    ];

    /**
     * Get the document type for this fornecedor.
     *
     * @return BelongsTo
     */
    public function documentoTipo(): BelongsTo
    {
        return $this->belongsTo(DocumentoTipoEloquentModel::class, 'documento_tipo_id', 'id');
    }

    /**
     * Get the endereco associated with this fornecedor.
     *
     * @return BelongsTo
     */
    public function endereco(): BelongsTo
    {
        return $this->belongsTo(EnderecoEloquentModel::class, 'endereco_id', 'id');
    }
}
