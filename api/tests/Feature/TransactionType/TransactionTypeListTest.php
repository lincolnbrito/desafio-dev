<?php

namespace Tests\Feature\TransactionType;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTypeListTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_return_empty_results(): void
    {
        $response = $this->get(route('api.transaction-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_it_should_return_transaction_types(): void
    {
        $this->seed();

        $response = $this->get(route('api.transaction-types.index'));

        $response->assertStatus(200)
            ->assertJsonCount(9, 'data');
        $this->assertDatabaseCount('transaction_types', 9);
    }
}
