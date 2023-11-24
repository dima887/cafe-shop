<?php

namespace Facades;

use App\Facades\StripeFacade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StripeFacadeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object) [
            'user_id' => 1,
            'type_order_id' => 1,
            'products' => [
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
     * @covers \App\Facades\StripeFacade::payment
     */
    public function testPaymentMethod()
    {
        $stripe = new StripeFacade($this->data);

        $result = $stripe->payment();

        $this->assertStringContainsString('https://checkout.stripe.com', $result);
    }
}
