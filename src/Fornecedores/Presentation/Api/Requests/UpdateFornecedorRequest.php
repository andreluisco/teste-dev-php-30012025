<?php

namespace Src\Fornecedores\Presentation\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization logic as needed
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'                 => 'sometimes|required|string|max:255',
            'documento_tipo_id'    => 'sometimes|required|integer|exists:documento_tipos,id',
            'documento_numero'     => 'sometimes|required|string|max:14',
            'endereco_id'          => 'sometimes|required|integer|exists:enderecos,id',
            'endereco_numero'      => 'sometimes|required|string|max:10',
            'endereco_complemento' => 'nullable|string|max:255',
        ];
    }
}
