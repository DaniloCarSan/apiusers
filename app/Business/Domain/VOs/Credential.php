<?php

namespace App\Business\Domain\VOs;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

readonly class Credential
{
    public function __construct(public User $user, public NewAccessToken $accessToken)
    {
    }
}
