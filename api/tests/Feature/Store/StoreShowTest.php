<?php

namespace Tests\Feature\Store;

use App\Models\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_not_return_store(): void
    {
        $this->withoutExceptionHandling();
        $this->expectException(ModelNotFoundException::class);
        $this->get(route('api.stores.show', ['store' => 'invalidId']));
    }

    public function test_it_should_return_created_store(): void
    {
        $store = factory(Store::class)->create([
           'name' => 'ACME'
        ]);

        $response = $this->get(route('api.stores.show', ['store' => $store->id]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'ACME',
                    'balance' => $store->balance
                ]
            ]);
    }

}
