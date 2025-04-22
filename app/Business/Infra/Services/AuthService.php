<?php

namespace App\Business\Infra\Services;

use App\Business\Domain\Services\AuthService as IAuthService;
use App\Business\Domain\Repositories\UserRepository;
use App\Exceptions\AuthenticationException;
use App\Models\User;
use App\Notifications\Auth\UserLoggedInNewDevice;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class AuthService implements IAuthService
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function findUserByEmailAndPassword(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            throw new AuthenticationException("Email or password invalid");
        }

        if (!$this->checkPassword($password, $user->password)) {
            throw new AuthenticationException("Email or password invalid");
        }

        // if (!$user->hasVerifiedEmail()) {
        //     throw new AuthenticationException("Email not verified");
        // }

        return $user;
    }

    public function checkPassword(string $password, string $hash): bool
    {
        return Hash::check($password, $hash);
    }

    public function generateAccessToken(User $user, string $deviceName): NewAccessToken
    {
        return $user->createToken(
            $deviceName,
            expiresAt: now()->addDay(90)
        );
    }

    public function sendNotificationWhenLoggedInNewDevice(User $user, string $deviceName): void
    {
        $user->notify(new UserLoggedInNewDevice($deviceName));
    }

    public function sendEmailVerificationNotification(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
