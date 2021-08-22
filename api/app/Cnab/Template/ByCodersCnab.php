<?php

namespace App\Cnab\Template;

use App\Cnab\Contracts\Cnab;

class ByCodersCnab implements Cnab
{
    public const LINE_SIZE = 80;

    public function isValidLine($content): bool
    {
        if(is_array($content) && empty($content)) {
            return false;
        }

        $content = is_array($content) ? $content[0] : $content;
        return mb_strlen(rtrim($content, PHP_EOL)) === self::LINE_SIZE;
    }

    public function parse($line): array
    {
        return [
            'type' => (int) $line[0],
            'date' => substr($line, 1,8),
            'amount' => (float)substr($line, 9, 10) / 100,
            'document' => substr($line, 19, 11),
            'credit_card' => substr($line, 30, 12),
            'hour' => substr($line, 42, 6),
            'owner' => trim(substr($line, 48, 14)),
            'store' => trim(substr($line, 62, 19)),
        ];
    }
}
