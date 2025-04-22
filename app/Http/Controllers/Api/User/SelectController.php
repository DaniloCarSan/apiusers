<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Domain\UseCases\User\Select\UseCase;
use App\Business\Domain\UseCases\User\Select\Input;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\UserResource;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function __construct(
        private UseCase $select
    ) {
    }

    public function execute(Request $request, $id)
    {
        $input = new Input(
            id: $id
        );
    
        $user = $this->select->execute($input);

        return new UserResource($user);
    }
}