<?php

namespace App\Parser;

use Exception;

class CnabParser
{

    public function parseContent($rawContent)
    {
        $exploded = explode(PHP_EOL, trim($rawContent));

        if(!self::isCnabHeader($exploded)) {
            throw new Exception('Invalid CNAB file format');
        }
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
