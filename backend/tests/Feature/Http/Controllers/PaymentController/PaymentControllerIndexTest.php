<?php

namespace Http\Controllers\PaymentController;

use App\Http\Controllers\PaymentController;
use App\Http\Requests\Payment\StripeCreateRequest;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->requestData = [
            'user_id' => 1,
            'type_order_id' => 1,
            'product' => [
                'id' => [2],
                'name' => ['Latte'],
                'price' => [5],
                'quantity' => [1],
            ],
            'success_url' => 'http://localhost:3000/?success=true',
            'cancel_url' => 'http://localhost:3000/?success=false',
        ];
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::index
     */
    public function it_returns_stripe_payment_page_url_on_success()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/payment', $this->requestData);

        $response->assertStatus(200);

        $response->assertJsonStructure([
                'success'
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::index
     */
    public function it_returns_401_if_user_unauthenticated()
    {
        $response = $this->postJson('/api/payment', $this->requestData);

        $response->assertStatus(401);

        $response->assertJson(['error' => 'Unauthenticated.']);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::index
     */
    public function it_returns_validation_error_on_invalid_request_data()
    {
        $user = User::factory()->create();
        $user->createToken('test-token')->plainTextToken;
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/payment', []);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                'errors' => [
                    'user_id',
                    'type_order_id',
                    'success_url',
                    'cancel_url',
                ],
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::index
     */
    public function it_handles_api_error_and_returns_500_status()
    {
        $this->mock(PaymentController::class, function ($mock) {
            $mock->shouldReceive('payment')->andThrow(new \Exception());
        });

        $response = $this->postJson('/api/payment', $this->requestData);

        $response->assertStatus(500);

        $response->assertJson([
                'error' => 'Oops, there are temporary problems',
            ]);
    }
}
