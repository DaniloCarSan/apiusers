<?php

namespace App\Exceptions;

use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessException extends Exception
{

    public $data;

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
        return response()->json([
            'status' => $this->getCode(),
            'title' => $this->getMessage(),
            'invalid-params' => $this->data,
        ], $this->getCode(), ['Content-Type' => 'application/problem+json']);
    }

}