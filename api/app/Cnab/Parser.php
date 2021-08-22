<?php

namespace App\Cnab;

use App\Cnab\Contracts\Cnab;
use Exception;

class Parser
{
    protected $model;

    public function __construct(Cnab $model)
    {
        $this->model = $model;
    }

    /**
     * @throws Exception
     */
    public function parseContent($rawContent): array
    {
        $exploded = array_filter(explode(PHP_EOL, $rawContent));

        if(!$this->model->isValidLine($exploded)) {
            throw new Exception('Invalid CNAB file format');
        }

        $result = [];

        foreach ($exploded as $line ) {
            $result[] = $this->parseLine($line);
        }

        return $result;
    }

    /**
     * @param string $line
     * @return array|null
     * @throws Exception
     */
    public function parseLine(string $line): ?array
    {
        if($line === '' || !$this->model->isValidLine($line)) {
            throw new Exception('Invalid line format');
        }

        return $this->model->parseLine($line);
    }
}
