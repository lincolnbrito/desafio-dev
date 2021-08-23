<?php

namespace Tests\Feature\Store;

use App\Models\Owner;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_return_empty_results(): void
    {
        $response = $this->get(route('api.stores.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_it_should_return_a_valid_store(): void
    {
        $owner = factory(Owner::class)->create();
        factory(Store::class, 2)->create([
            'owner_id' => $owner->id,
            'balance' => 0
        ]);

        $response = $this->get(route('api.stores.index'));
        $response->assertStatus(200)
            ->assertJsonCount(2, 'data')
            ->assertJsonPath('data.0.balance', '0.00');
        $this->assertDatabaseCount('stores', 2);

    }

}
