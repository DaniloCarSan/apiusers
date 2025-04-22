<?php

namespace App\Business\Domain\UseCases\SingIn;

readonly class Input
{
    public function __construct(
        public ?string $email,
        public ?string $password,
        public ?string $deviceName
    ) {
    }
}
