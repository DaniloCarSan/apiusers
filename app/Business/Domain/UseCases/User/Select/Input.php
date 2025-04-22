<?php

namespace App\Business\Domain\UseCases\User\Select;

readonly class Input
{
    public function __construct(
        public ?int $id
    ) {
    }
}
