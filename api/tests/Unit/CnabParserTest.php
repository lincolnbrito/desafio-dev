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
     *
     * @throws Exception
     */
    public function test_it_cannot_parse_empty_content() {
        $this->expectExceptionMessage("Invalid CNAB file format");

        $content = "";
        $this->parser->parseContent($content);
    }
}
