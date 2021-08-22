<?php

namespace Tests\Unit\Cnab;

use App\Cnab\Parser;
use App\Cnab\Template\ByCodersCnab;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ParserTest extends TestCase
{
    public $parser;

    public function setUp(): void
    {
        $this->parser = new Parser(app(ByCodersCnab::class));
        parent::setUp();
    }

    /**
     * @dataProvider provideInvalidContent
     * @throws Exception
     */
    public function test_it_cannot_parse_empty_content($content): void
    {
        $this->expectExceptionMessage("Invalid CNAB file format");

        $this->parser->parseContent($content);
    }

    public function test_it_cannot_parse_invalid_size_content(): void
    {
        $this->expectExceptionMessage("Invalid CNAB file format");

        $content = "3201903010000014200096206760174753****3153";
        $this->parser->parseContent($content);
    }

    public function test_it_can_parse_line(): void
    {
        $validContent = "3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       ";
        $result = $this->parser->parseLine($validContent);
        $this->assertIsArray($result);
    }

    /**
     * @dataProvider provideLineContent
     * @throws Exception
     */
    public function test_it_can_return_valid_parsed_line($line, $expected): void
    {
        $result = $this->parser->parseLine($line);

        $expectedFormat = [
            'type',
            'date',
            'amount',
            'document',
            'credit_card',
            'hour',
            'owner',
            'store',
        ];

        $this->assertIsArray($result);
        $this->assertEquals($expectedFormat, array_keys($result));
        $this->assertEquals($expected, $result);
    }


    /**
     * @dataProvider provideFiles
     * @throws Exception
     */
    public function test_it_can_parse_valid_files($file, $expected): void
    {
        Storage::fake();
        $path = Storage::putFileAs(null, $file,'CNAB.txt');
        $contentFile = Storage::get($path);

        $result = $this->parser->parseContent($contentFile);

        $this->assertIsArray($result);
        $this->assertCount($expected, $result);
    }

    public function provideFiles(): array
    {
        return [
            'oneline' => [
                UploadedFile::fake()->createWithContent('filename', "3201903010000014200096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO       "),
                1
            ],
            'multiline' => [
                UploadedFile::fake()->createWithContent('CNAB.txt', file_get_contents(__DIR__ . '/CNAB.txt')),
                21
            ]
        ];
    }

    public function provideInvalidContent(): array
    {
        return [
            'invalid1' => [ "" ],
            'invalid2' => [ PHP_EOL ],
            'invalid3' => [ "3201903010000014200096206760174753****3153153453      " ],
            'invalid4' => [ "3201903010000014200096206760174753****3153153453AAAO MACEDO   BAR DO JOÃO    " ],
        ];
    }

    public function provideLineContent(): array
    {
        return [
            'line1' => [
                '3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       ',
                [
                    'type' => 3,
                    'date' => '20190301',
                    'amount' => 142.0,
                    'document' => '09620676017',
                    'credit_card' => '4753****3153',
                    'hour' => '153453',
                    'owner' => 'JOÃO MACEDO',
                    'store' => 'BAR DO JOÃO',
                ]
            ],
            'line2' => [
                '5201903010000013200556418150633123****7687145607MARIA JOSEFINALOJA DO Ó - MATRIZ',
                [
                    "type" => 5,
                    "date" => "20190301",
                    "amount" => 132.0,
                    "document" => "55641815063",
                    "credit_card" => "3123****7687",
                    "hour" => "145607",
                    "owner" => "MARIA JOSEFINA",
                    "store" => "LOJA DO Ó - MATRIZ"
                ]
            ]
        ];
    }


}
