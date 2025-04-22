<?php

namespace App\Business\Domain\UseCases\User\Delete;

readonly class Input
{
    public function __construct(
        public ?int $id
    ) {
    }
}
