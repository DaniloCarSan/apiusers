<?php

namespace App\Business\Domain\UseCases\User\Create;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class Input
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $password
    ) { 
    }

    public function createEntity(): User
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);

        return $user;
    }
}
