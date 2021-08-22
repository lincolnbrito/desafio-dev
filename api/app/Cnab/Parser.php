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
     * @param string $line
     * @return array|null
     * @throws Exception
     */
    public function parse(string $line): ?array
    {
        if(!$this->isValid($line)) {
            throw new Exception('Invalid line format');
        }

        return $this->model->parse($line);
    }

    public function isValid($line): bool
    {
        return $this->model->isValidLine($line);
    }
}
