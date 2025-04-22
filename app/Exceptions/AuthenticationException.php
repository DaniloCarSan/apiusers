<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): bool
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): JsonResponse|bool
    {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'title' => empty($this->message) ? 'Unauthorized for action' : $this->message,
            ], Response::HTTP_UNAUTHORIZED, ['Content-Type' => 'application/problem+json']);
        }

        return false;
    }
}
