<?php

namespace App\Business\Domain\UseCases\SingIn;

use App\Business\Domain\Services\AuthService;
use App\Business\Domain\VOs\Credential;
use App\Utils\ValidatorAdapter;

class UseCase
{

    public function __construct(
        private AuthService $authService
    ) {
    }

    public function execute(Input $input): Credential
    {
        $this->validate($input);

        $user = $this->authService->findUserByEmailAndPassword(
            $input->email,
            $input->password
        );

        $accessToken = $this->authService->generateAccessToken(
            $user,
            $input->deviceName
        );

        $this->authService->sendNotificationWhenLoggedInNewDevice(
            $user,
            $input->deviceName
        );

        return new Credential(
            $user,
            $accessToken
        );
    }

    public function validate(Input $input)
    {
        $this->validateEmail($input->email);
        $this->validatePassword($input->password);
        $this->validateDeviceName($input->deviceName);
    }

    public function validateEmail(?string $email): void
    {
        ValidatorAdapter::field('email', $email, 'required|string|email');
    }

    public function validatePassword(?string $password): void
    {
        ValidatorAdapter::field('password', $password, 'required|string|min:6');
    }

    public function validateDeviceName(?string $deviceName): void
    {
        ValidatorAdapter::field('deviceName', $deviceName, 'required|string');
    }
}
