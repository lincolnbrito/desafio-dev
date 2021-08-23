<?php

namespace Tests\Feature\Owner;

use App\Models\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_return_empty_results(): void
    {
        $response = $this->get(route('api.owners.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data');
    }

    public function test_it_should_return_owner(): void
    {
        factory(Owner::class)->create();

        $response = $this->get(route('api.owners.index'));
        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
        $this->assertDatabaseCount('owners', 1);
    }
}
