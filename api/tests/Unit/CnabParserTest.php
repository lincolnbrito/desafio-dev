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

    public function provideContent(): array
    {
        return [
            'invalidSize' => [
                ""
            ],
        ];
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
}
