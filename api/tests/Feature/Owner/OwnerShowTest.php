<?php

namespace Tests\Feature\Owner;

use App\Models\Owner;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_not_return_owner(): void
    {
        $this->withoutExceptionHandling();
        $this->expectException(ModelNotFoundException::class);
        $this->get(route('api.owners.show', ['owner' => 'invalidId']));
    }

    public function test_it_should_return_created_store(): void
    {
        $owner = factory(Owner::class)->create();

        $response = $this->get(route('api.owners.show', ['owner' => $owner->id]));

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $owner->name
                ]
            ]);
    }
}
