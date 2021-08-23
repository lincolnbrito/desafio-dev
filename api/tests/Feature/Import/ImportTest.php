<?php

namespace Tests\Feature\Import;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_import_valid_file(): void
    {
        $this->seed();

        Storage::fake();
        $file = UploadedFile::fake()->createWithContent(
            'CNAB.txt',
            implode(PHP_EOL, [
                "3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       ",
                "5201903010000013200556418150633123****7687145607MARIA JOSEFINALOJA DO Ó - MATRIZ",
                "3201903010000012200845152540736777****1313172712MARCOS PEREIRAMERCADO DA AVENIDA",
            ])
        );

        $response = $this->post(route('api.import'), [
            'file' => $file
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('transactions', 3);
    }

    public function test_it_should_validate_file(): void
    {
        $response = $this->json('POST', route('api.import'), ['file' => 'invalid'],
            ['Accept' => 'application/json']
        );
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);

        $image = UploadedFile::fake()->image('image.jpg');
        $response = $this->json('POST', route('api.import'), ['file' => $image],
            ['Accept' => 'application/json']
        );
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }
}
