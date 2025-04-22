<?php

namespace App\Business\Infra\Repositories;

use App\Exceptions\RepositoryException;
use App\Business\Domain\Repositories\UserRepository as IUserRepository;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class UserRepository implements IUserRepository
{

    public function create(User $user): ?User
    {
        try {
            $user->save();
            return $user;
        } catch (\Throwable $e) {
            throw new RepositoryException("Erro ao criar usuário", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function findByEmail(string $email): ?User
    {
        try {
            return User::where('email', $email)->first();
        } catch (\Throwable $e) {
            throw new RepositoryException("Erro ao buscar usuário por email", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function findById(int $id): ?User
    {
        try {
            return User::find($id);
        } catch (\Throwable $e) {
            throw new RepositoryException("Erro ao buscar usuário por id", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function existByEmail(string $email): bool
    {
        try {
            return User::where('email', $email)->exists();
        } catch (\Throwable $e) {
            throw new RepositoryException("Erro ao verificar se o usuário existe pelo email informado", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function list(?string $search, int $page, int $perPage): LengthAwarePaginator
    {
        try {

            if (!is_null($search)) {
                return User::where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search)
                    ->orderBy('id', 'asc')->paginate($perPage, ['*'], 'page', $page);
            }

            return User::orderBy('id', 'asc')->paginate($perPage, ['*'], 'page', $page);
        } catch (\Throwable $e) {
            throw new RepositoryException($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function Update(User $user): ?User
    {
        try {
            $user->save();
            return $user;
        } catch (\Throwable $e) {
            throw new RepositoryException("Erro ao atualizar usuário", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
