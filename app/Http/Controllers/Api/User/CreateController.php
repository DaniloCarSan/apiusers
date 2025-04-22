<?php

namespace App\Http\Controllers\Api\User;

use App\Business\Domain\UseCases\User\Create\UseCase;
use App\Business\Domain\UseCases\User\Create\Input;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\UserResource;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct(
        private UseCase $create
    ) {
    }

    public function execute(Request $request)
    {
        $input = new Input(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
        );
    
        $user = $this->create->execute($input);

        return new UserResource($user);
    }
}