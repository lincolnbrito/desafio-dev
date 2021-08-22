<?php

namespace Tests\Unit;

use App\Parser\CnabParser;
use Tests\TestCase;

class CnabParserTest extends TestCase
{
    public $parser;

    public function setUp(): void
    {
        $this->parser = new CnabParser;
        parent::setUp();
    }
}
