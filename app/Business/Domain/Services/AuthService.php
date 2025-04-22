<?php

namespace App\Business\Domain\Services;

use App\Models\User;

interface AuthService {
    public function findUserByEmailAndPassword(string $email, string $password): User;
    public function generateAccessToken(User $user, string $deviceName);
    public function checkPassword(string $password, string $hash): bool;
    public function sendNotificationWhenLoggedInNewDevice(User $user, string $deviceName): void;
    public function sendEmailVerificationNotification(User $user): void;
}