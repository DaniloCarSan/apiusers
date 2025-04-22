<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Domain\UseCases\User\List\Input;
use App\Business\Domain\UseCases\User\List\UseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __construct(
        private UseCase $list
    ) {
    }

    public function execute(Request $request)
    {
        $input = new Input(
            search: $request->input('search'),
            page: $request->input('page', 1),
            perPage: $request->input('perPage', 20)
        );

        $users = $this->list->execute($input);

        return $users;
    }
}
