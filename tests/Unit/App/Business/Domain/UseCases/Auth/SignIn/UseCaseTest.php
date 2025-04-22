<?php

namespace Tests\Unit\App\Business\Domain\UseCases\Auth\SignIn;

use App\Business\Domain\Services\AuthService;
use App\Business\Domain\UseCases\SingIn\Input;
use App\Business\Domain\UseCases\SingIn\UseCase;
use App\Business\Domain\VOs\Credential;
use App\Exceptions\ValidatorAdapterException;
use App\Models\User;
use Laravel\Sanctum\NewAccessToken;
use Mockery;
use Tests\TestCase;

class UseCaseTest extends TestCase
{

    public function test_deve_realizar_login(): void
    {

        $input = new Input(
            'test@test.com',
            'password',
            'Iphone Pro Max'
        );

        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $user = new User();

        $authService->expects($this->once())
            ->method('findUserByEmailAndPassword')
            ->willReturn($user);

        $token = Mockery::mock(NewAccessToken::class);

        $authService->expects($this->once())
            ->method('generateAccessToken')
            ->willReturn($token);
        
        $authService->expects($this->once())
            ->method('sendNotificationWhenLoggedInNewDevice');

        $useCase = new UseCase($authService);

        $output = $useCase->execute($input);

        $this->assertInstanceOf(Credential::class, $output);
        $this->assertSame($user, $output->user);
        $this->assertSame($token, $output->accessToken);
    }

    public function test_deve_lancar_uma_excecao_ao_passar_email_vazio(): void
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->expectException(ValidatorAdapterException::class);

        $useCase->validateEmail('');
    }

    public function test_deve_lancar_uma_excecao_ao_passar_email_invalido(): void
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->expectException(ValidatorAdapterException::class);

        $useCase->validateEmail('invalido');
    }

    public function test_deve_lancar_uma_excecao_ao_passar_password_vazio(): void
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->expectException(ValidatorAdapterException::class);

        $useCase->validatePassword('');
    }

    public function test_deve_lancar_uma_excecao_com_password_menor_que_6_caracteres(): void
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->expectException(ValidatorAdapterException::class);

        $useCase->validatePassword('12345');
    }

    public function test_deve_lancar_uma_excecao_com_device_vazio(): void
    {
        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->expectException(ValidatorAdapterException::class);

        $useCase->validateDeviceName('');
    }

    public function test_deve_passar_quando_todos_parametros_for_valido(): void
    {
        $input = new Input(
            email: 'test@gmail.com',
            password: '123456',
            deviceName: 'Iphone 14 Pro Max'
        );

        $authService = $this->getMockBuilder(AuthService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $useCase = new UseCase($authService);

        $this->assertNull($useCase->validate($input));
    }
}
