<?php

namespace App\Business\Domain\UseCases\User\Update;

use App\Business\Domain\Repositories\UserRepository;
use App\Exceptions\UserException;
use App\Http\Resources\Api\Auth\UserResource;
use App\Utils\ValidatorAdapter;
use Illuminate\Http\Response;

class UseCase
{

    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function execute(Input $input): UserResource
    {
        $this->validate($input);

        if (!$user = $this->repository->findById($input->id)) {
            throw new UserException("Usuário não encontrado", Response::HTTP_NOT_FOUND);
        }

        $user = $this->repository->update($input->updateEntity($user));

        return new UserResource(
            $user
        );
    }

    public function validate(Input $input)
    {
        $this->validateId($input->id);
        $this->validateName($input->name);
    }

    public function validateId($id): void
    {
        ValidatorAdapter::field('id', $id, 'required|numeric');
    }

    public function validateName(?string $name): void
    {
        ValidatorAdapter::field('name', $name, 'required|string|min:1|max:255');
    }
}
