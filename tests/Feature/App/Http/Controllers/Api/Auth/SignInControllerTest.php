<?php

namespace Tests\Feature\App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    public function test_deve_realizar_login_na_api(): void
    {
        User::factory()->create([
            'name' => 'Danilo Santos',
            'email' => 'danilocarsan@gmail.com',
        ]);
        
        $response = $this->post('/api/auth/sign/in',[
            "email"=> "danilocarsan@gmail.com",
            "password"=> "password",
            "deviceName"=> "Iphone 14 Pro Max" 
        ]);

        $response->assertStatus(200);
    }

    public function test_deve_retornar_um_erro_para_email_ou_senha_incorretos(): void
    {
        $response = $this->post('/api/auth/sign/in',[
            "email"=> "user.not.exists@test.com",
            "password"=> "password",
            "deviceName"=> "Iphone 14 Pro Max" 
        ]);

        $response->assertStatus(401);
    }
}