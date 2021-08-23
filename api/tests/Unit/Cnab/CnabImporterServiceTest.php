<?php

namespace Tests\Unit\Cnab;

use App\Cnab\Contracts\Cnab;
use App\Models\Store;
use App\Services\CnabImporterService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CnabImporterServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $service;

    public function setUp(): void
    {
        $this->service = app(CnabImporterService::class);
        parent::setUp();
    }

    public function atest_it_should_return_a_valid_cnab_template(): void
    {
        $template = $this->service->getTemplateClass();

        $this->assertTrue(is_subclass_of($template, Cnab::class));
    }

    public function test_can_import_content(): void
    {
        $this->seed();

        $arrayLines = file($this->getFixtureDir()."/CNAB.txt", FILE_IGNORE_NEW_LINES );

        $this->service->import($arrayLines);
        $this->assertDatabaseCount('stores', 5);
        $this->assertDatabaseCount('owners', 4);
        $this->assertDatabaseCount('transactions', 21);
    }

    /**
     * @dataProvider provideTransactions
     */
    public function test_it_should_return_valid_balance($file, $expected_amount): void
    {
        $this->seed();

        Storage::fake();
        $path = Storage::putFileAs(null, $file,'CNAB.txt');
        $content = Storage::get($path);

        $sanitizedData = array_filter(explode(PHP_EOL, $content));
        $this->service->import($sanitizedData);

        $balance = Store::all()->sum('balance');
        $this->assertEquals($expected_amount, $balance);
    }

    public function provideTransactions(): array
    {
        return [
            '-$100,00' => [
                UploadedFile::fake()->createWithContent(
                    'filename',
                    implode(PHP_EOL, [
                        "1201903010000015000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                        "2201903010000025000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       "
                    ])
                ),
                -100
            ],
            '$400,00' => [
                UploadedFile::fake()->createWithContent(
                    'filename',
                    implode(PHP_EOL, [
                        "1201903010000015000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                        "1201903010000025000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       "
                    ])
                ),
                400
            ],
            '$600,00' => [
                UploadedFile::fake()->createWithContent(
                    'filename',
                    implode(PHP_EOL, [
                        "1201903010000015000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                        "1201903010000020000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                        "1201903010000025000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                    ])
                ),
                600
            ],
            '$0,00' => [
                UploadedFile::fake()->createWithContent(
                    'filename',
                    implode(PHP_EOL, [
                        "1201903010000015000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                        "2201903010000015000096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       ",
                    ])
                ),
                0
            ],
        ];
    }
}
