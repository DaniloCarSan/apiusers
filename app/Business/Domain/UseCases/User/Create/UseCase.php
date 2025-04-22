<?php

namespace App\Business\Domain\UseCases\User\Create;

use App\Business\Domain\Repositories\UserRepository;
use App\Business\Domain\Services\AuthService;
use App\Exceptions\UserException;
use App\Http\Resources\Api\Auth\UserResource;
use App\Models\User;
use App\Utils\ValidatorAdapter;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Response;

class UseCase
{

    public function __construct(
        private UserRepository $repository,
        private AuthService $authService
    ) {
    }

    public function execute(Input $input): UserResource
    {
        $this->validate($input);

        if ($this->repository->existByEmail($input->email)) {
            throw new UserException(
                'E-mail já registrado',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = $input->createEntity();

        $user = $this->repository->create($user);

        $this->authService->sendEmailVerificationNotification($user);

        return new UserResource(
            $user
        );
    }

    public function validate(Input $input)
    {
        $this->validateName($input->name);
        $this->validateEmail($input->email);
        $this->validatePassword($input->password);
    }

    public function validateName(?string $name): void
    {
        ValidatorAdapter::field('name', $name, 'required|string|min:1|max:255');
    }

    public function validateEmail(?string $email): void
    {
        ValidatorAdapter::field('email', $email, 'required|string|email|max:255');
    }

    public function validatePassword(?string $password): void
    {
        ValidatorAdapter::field('password', $password, 'required|string|min:8|max:255');
    }
}
