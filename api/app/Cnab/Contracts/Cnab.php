<?php

namespace App\Cnab\Contracts;

interface Cnab
{
    public function isValidLine($content): bool;
    public function parse($line): array;
}
