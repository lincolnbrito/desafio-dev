<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getFileFixtureContent($file) {
        return file_get_contents($this->getFixtureDir().$file);
    }

    public function getFixtureDir(): string
    {
        return __DIR__.'/fixtures/';
    }
}
