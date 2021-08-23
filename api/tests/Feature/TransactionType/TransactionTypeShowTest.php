<?php

namespace Tests\Feature\TransactionType;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTypeShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_not_return_store(): void
    {
        $this->withoutExceptionHandling();
        $this->expectException(ModelNotFoundException::class);
        $this->get(route('api.transaction-types.show', ['transaction_type' => 'invalidId']));
    }

    public function test_it_should_return_a_valid_transaction_type(): void
    {
        $this->seed();

        $response = $this->get(route('api.transaction-types.show', ['transaction_type' => 1]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'description' => 'Débito',
                    'type' => 'income',
                    'operator' => '+'
                ]
            ]);
    }
}
