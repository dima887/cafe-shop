<?php

namespace Http\Controllers\AuthController;

use App\Http\Controllers\AuthController;
use Database\Factories\AdminFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthControllerLogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::logout
     */
    public function test_user_can_logout()
    {
        $user = AdminFactory::new()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Logged out successfully!',
        ]);

        $response->assertCookie('token', null);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::logout
     */
    public function it_returns_unauthenticated_error_when_user_not_authenticated()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);

        $response->assertJson([
            'error' => 'Unauthenticated.',
        ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\AuthController::logout
     */
    public function it_handles_internal_server_error()
    {
        $this->mock(AuthController::class, function ($mock) {
            $mock->shouldReceive('logout')->andThrow(new \Exception());
        });

        $response = $this->postJson('/api/logout');

        $response->assertStatus(500);

        $response->assertJson(['error' => 'Oops, there are temporary problems']);
    }
}
