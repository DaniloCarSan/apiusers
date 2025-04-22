<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Domain\UseCases\User\Update\UseCase;
use App\Business\Domain\UseCases\User\Update\Input;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\UserResource;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __construct(
        private UseCase $update
    ) {
    }

    public function execute(Request $request, $id)
    {
        $input = new Input(
            $id,
            $request->input('name'),
        );
    
        $user = $this->update->execute($input);

        return new UserResource($user);
    }
}