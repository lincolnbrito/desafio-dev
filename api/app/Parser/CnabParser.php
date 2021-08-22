<?php

namespace App\Parser;

use Exception;

class CnabParser
{

    /**
     * @throws Exception
     */
    public function parseContent($rawContent)
    {
        $exploded = explode(PHP_EOL, trim($rawContent));

        if(!self::isCnabHeader($exploded)) {
            throw new Exception('Invalid CNAB file format');
        }
    }

    /**
     * @param string $line
     * @return array|null
     * @throws Exception
     */
    public function parseLine(string $line): ?array
    {
        if($line === '' || !self::isCnabHeader($line)) {
            throw new Exception('Invalid line format');
        }

        return [
            'transaction_type' => (int) $line[0],
            'date' => substr($line, 1,8),
            'amount' => (float)substr($line, 9, 10) / 100,
            'document' => substr($line, 19, 11),
            'credit_card' => substr($line, 30, 12),
            'hour' => substr($line, 42, 6),
            'owner' => trim(substr($line, 48, 14)),
            'store' => trim(substr($line, 62, 19)),
        ];
    }

    /**
     * @param $content
     * @return bool
     */
    public static function isCnabHeader($content): bool
    {
        $content = is_array($content) ? $content[0] : $content;
        return mb_strlen(rtrim($content, PHP_EOL)) === 80;
    }
}
