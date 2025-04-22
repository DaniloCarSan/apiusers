<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Domain\UseCases\User\Delete\UseCase;
use App\Business\Domain\UseCases\User\Delete\Input;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\UserResource;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __construct(
        private UseCase $delete
    ) {
    }

    public function execute(Request $request, $id)
    {
        $input = new Input(
            id: $id
        );
    
        $user = $this->delete->execute($input);

        return new UserResource($user);
    }
}