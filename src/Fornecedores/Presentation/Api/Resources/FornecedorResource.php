<?php

namespace Src\Fornecedores\Presentation\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FornecedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'                   => $this->id,
            'nome'                 => $this->nome,
            'documento_tipo_id'    => $this->documento_tipo_id,
            'documento_numero'     => $this->documento_numero,
            'endereco_id'          => $this->endereco_id,
            'endereco_numero'      => $this->endereco_numero,
            'endereco_complemento' => $this->endereco_complemento,
            'created_at'           => $this->created_at,
            'updated_at'           => $this->updated_at,
        ];
    }
}
