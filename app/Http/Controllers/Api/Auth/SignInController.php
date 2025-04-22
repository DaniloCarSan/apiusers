<?php

namespace App\Http\Controllers\Api\Auth;

use App\Business\Domain\UseCases\SingIn\Input;
use App\Business\Domain\UseCases\SingIn\UseCase;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\CredentialResource;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __construct(
        private UseCase $signIn
    ) {
    }

    public function execute(Request $request)
    {
        $input = new Input(
            email: $request->input('email'),
            password: $request->input('password'),
            deviceName: $request->input('deviceName')
        );
    
        $credential = $this->signIn->execute($input);

        return new CredentialResource($credential);
    }
}
