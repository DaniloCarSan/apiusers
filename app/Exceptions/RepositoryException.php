<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepositoryException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): bool
    {
        return true;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse|bool
    {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'title' => empty($this->message) ? 'Ocorreu um erro interno no servidor' : $this->message,
                'datail' => 'Ocorreu um erro interno no servidor, nossa equipe já foi notificada e já estamos trabalhando nisso, por favor tente novamente mais tarde'
            ], Response::HTTP_INTERNAL_SERVER_ERROR, ['Content-Type' => 'application/problem+json']);
        }

        return false;
    }
}
