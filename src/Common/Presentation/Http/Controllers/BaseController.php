<?php

namespace Src\Common\Presentation\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Common\Infrastructure\Laravel\Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     */
    public function sendResponse(
        $result,
        $message,
        $code = 200
    ): JsonResponse {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param string      $title  Título breve do erro
     * @param string|null $detail Descrição mais longa do erro
     * @param int         $status Código de status HTTP
     * @param array       $errors Detalhes adicionais, como campos específicos com erros de validação
     */
    public function sendError(
        string $title,
        ?string $detail = null,
        int $status = 500,
        array $errors = []
    ): JsonResponse {
        $response = [
            'status'  => $status,
            'title'   => $title,
            'message' => $detail ?? $title,
            'errors'  => !empty($errors) ? $errors : null,
        ];

        return response()->json($response, $status);
    }
}
