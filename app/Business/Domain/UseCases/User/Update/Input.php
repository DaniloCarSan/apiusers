<?php

namespace App\Business\Domain\UseCases\User\Update;

use App\Models\User;

readonly class Input
{
    public function __construct(
        public ?int $id,
        public ?string $name
    ) { 
    }

    public function updateEntity(User $user): User
    {
        $user->setName($this->name);
        return $user;
    }
}
