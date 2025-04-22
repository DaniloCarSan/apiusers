<?php

namespace App\Business\Domain\UseCases\User\List;

use App\Business\Domain\Repositories\UserRepository;
use App\Utils\ValidatorAdapter;
use Illuminate\Pagination\LengthAwarePaginator;

class UseCase
{

    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function execute(Input $input): LengthAwarePaginator
    {
        $this->validate($input);

        return $this->repository->list(
            $input->search,
            $input->page,
            $input->perPage
        );
    }

    public function validate(Input $input)
    {
        $this->validateSearch($input->search);
        $this->validatePage($input->page);
        $this->validatePerPage($input->perPage);
    }

    public function validateSearch($search): void
    {
        ValidatorAdapter::field('search', $search, 'nullable|string|max:100');
    }

    public function validatePage($page): void
    {
        ValidatorAdapter::field('page', $page, 'required|numeric');
    }

    public function validatePerPage($perPage): void
    {
        ValidatorAdapter::field('perPage', $perPage, 'nullable|numeric|max:50');
    }
}
