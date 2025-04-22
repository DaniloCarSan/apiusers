<?php

namespace App\Utils;

use App\Exceptions\ValidatorAdapterException;
use Illuminate\Support\Facades\Validator;

class ValidatorAdapter
{
    /**
     *  @throws App\Exceptions\ValidatorAdapterException
     */
    public static function field(
        string $fieldName,
        $fieldValue,
        $rules,
        array $messages = []
    ): void {
        $data = [$fieldName => $fieldValue];
        $rules = [$fieldName => $rules];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidatorAdapterException(
                data: $validator->errors()->toArray()
            );
        }
    }

    /**
     *  @throws App\Exceptions\ValidatorAdapterException
     */
    public static function fields(
        array $data,
        array $rules,
        array $messages = []
    ): void {
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidatorAdapterException(
                data: $validator->errors()->toArray()
            );
        }
    }
}