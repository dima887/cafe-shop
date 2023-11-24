<?php

namespace Http\Controllers\PaymentController;

use App\Http\Controllers\PaymentController;
use App\Services\PaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentControllerWebhookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::webhook
     */
    public function it_handles_stripe_webhook_successfully()
    {
        $this->mock(PaymentService::class, function ($mock) {
            $mock->shouldReceive('webhook')->andReturn(true);
        });

        $response = $this->postJson('/api/payment/webhook');

        $response->assertStatus(200);

        $response->assertJson([
                'success' => true,
            ]);
    }

    /**
     * @test
     * @covers \App\Http\Controllers\PaymentController::webhook
     */
    public function it_handles_stripe_webhook_failure_and_returns_500_status()
    {
        $this->mock(PaymentController::class, function ($mock) {
            $mock->shouldReceive('webhook')->andThrow(new \Exception());
        });

        $response = $this->postJson('/api/payment/webhook');

        $response->assertStatus(500)
            ->assertJson([
                'error' => 'Oops, there are temporary problems',
            ]);
    }
}
