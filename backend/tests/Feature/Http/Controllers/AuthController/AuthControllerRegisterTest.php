<?php

namespace Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerRegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'SERDTrfygvh!@#123',
        ];
    }
    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::register
     */
    public function it_registers_a_user_successfully()
    {

        $response = $this->postJson('/api/register', $this->user);

        $response->assertStatus(200);

        $response->assertJsonStructure([
                'user' => [
                    'created_at',
                    'email',
                    'id',
                    'name',
                    'updated_at',
                ],
            ]);

        $response->assertCookie('token');
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::register
     */
    public function it_returns_validation_error_on_invalid_input()
    {
        $response = $this->json('POST', '/api/register', []);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'email',
                ],
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::register
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(AuthController::class, function ($mock) {
            $mock->shouldReceive('register')->andThrow(new \Exception());
        });

        $response = $this->post('/api/register', $this->user);

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
