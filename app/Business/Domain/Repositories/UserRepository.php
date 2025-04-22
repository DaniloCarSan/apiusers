<?php

namespace App\Business\Domain\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository {
    public function create(User $user): ?User;
    public function findByEmail(string $email): ?User;
    public function findById(int $id): ?User;
    public function list(?string $search, int $page, int $perPage): LengthAwarePaginator;
    public function Update(User $user): ?User;
    public function existByEmail(string $email): bool;
}