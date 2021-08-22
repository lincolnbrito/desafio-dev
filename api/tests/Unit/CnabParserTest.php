<?php

namespace Tests\Unit;

use App\Parser\CnabParser;
use Exception;
use Tests\TestCase;

class CnabParserTest extends TestCase
{
    public $parser;

    public function setUp(): void
    {
        $this->parser = new CnabParser;
        parent::setUp();
    }

    /**
     * @throws Exception
     */
    public function test_it_cannot_parse_empty_content(): void
    {
        $this->expectExceptionMessage("Invalid CNAB file format");

        $content = "";
        $this->parser->parseContent($content);
    }

    public function test_it_cannot_parse_invalid_size_content(): void
    {
        $this->expectExceptionMessage("Invalid CNAB file format");

        $content = "3201903010000014200096206760174753****3153";
        $this->parser->parseContent($content);
    }

    public function test_it_can_parse_line()
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
            'transaction_type',
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

    public function provideLineContent(): array
    {
        return [
            'line1' => [
                '3201903010000014200096206760174753****3153153453JOÃO MACEDO   BAR DO JOÃO       ',
                [
                    'transaction_type' => 3,
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
                    "transaction_type" => 5,
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
