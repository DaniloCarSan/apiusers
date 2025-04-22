<?php

namespace App\Business\Domain\UseCases\User\Delete;

use App\Business\Domain\Repositories\UserRepository;
use App\Exceptions\UserException;
use App\Models\User;
use App\Utils\ValidatorAdapter;
use Illuminate\Http\Response;

class UseCase
{

    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function execute(Input $input): User
    {
        $this->validate($input);

        if (!$user = $this->repository->findById($input->id)) {
            throw new UserException("Usuário não encontrado", Response::HTTP_NOT_FOUND);
        }

        $user->delete();
        
        return $user;
    }

    public function validate(Input $input)
    {
        $this->validateId($input->id);
    }

    public function validateId($id): void
    {
        ValidatorAdapter::field('id', $id, 'required|numeric');
    }
}
