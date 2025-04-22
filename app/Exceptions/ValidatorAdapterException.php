<?php

namespace App\Exceptions;

class ValidatorAdapterException extends BusinessException
{
    public function __construct($data = null)
    {
        $this->data = $data;
        parent::__construct("Preencha os campos corretamente", 409);
    }
}