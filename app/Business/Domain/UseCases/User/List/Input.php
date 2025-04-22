<?php

namespace App\Business\Domain\UseCases\User\List;

readonly class Input
{
    public function __construct(
        public ?string $search,
        public ?int $page,
        public ?int $perPage
    ) {
    }
}
