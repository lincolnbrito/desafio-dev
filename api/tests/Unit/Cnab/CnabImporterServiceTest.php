<?php

namespace Tests\Unit\Cnab;

use App\Cnab\Contracts\Cnab;
use App\Services\CnabImporterService;
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

    public function test_imported_content_size()
    {
        $arrayLines = file(__DIR__.DIRECTORY_SEPARATOR."CNAB.txt", FILE_IGNORE_NEW_LINES );

        $result = $this->service->import($arrayLines);
        $this->assertCount(21, $result);
    }


}
