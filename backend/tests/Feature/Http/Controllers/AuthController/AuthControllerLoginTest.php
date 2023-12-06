<?php

namespace Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerLoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = AdminFactory::new(['password' => 'password'])->create();

        $this->data = [
            'email' => $user['email'],
            'password' => 'password',
        ];
    }
    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::login
     */
    public function it_logs_in_a_user_successfully()
    {

        $response = $this->postJson('/api/login', $this->data);

        $response->assertStatus(200);
        $response->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $response->assertCookie('token');
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::login
     */
    public function it_returns_unauthorized_on_invalid_credentials()
    {
        $invalidUserData = [
            'email' => 'admin@mail.com',
            'password' => 'wrong_password',
        ];

        $response = $this->json('POST', '/api/login', $invalidUserData);

        $response->assertStatus(401);

        $response->assertJson([
                'error' => 'Email or password is incorrect!',
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::login
     */
    public function it_returns_validation_error_on_invalid_input()
    {
        $response = $this->json('POST', '/api/login', []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                'errors' => [
                    'password',
                ],
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::login
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(AuthController::class, function ($mock) {
            $mock->shouldReceive('login')->andThrow(new \Exception());
        });

        $response = $this->post('/api/login', $this->data);

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
