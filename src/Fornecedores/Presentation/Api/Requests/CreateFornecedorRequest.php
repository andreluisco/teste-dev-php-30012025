<?php

namespace Src\Fornecedores\Presentation\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization logic as needed
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'                 => 'required|string|max:255',
            'documento_tipo_id'    => 'required|integer|exists:documento_tipos,id',
            'documento_numero'     => 'required|string|max:14',
            // Add specific CPF/CNPJ validation if needed
            'endereco_id'          => 'required|integer|exists:enderecos,id',
            'endereco_numero'      => 'required|string|max:10',
            'endereco_complemento' => 'nullable|string|max:255',
        ];
    }
}
