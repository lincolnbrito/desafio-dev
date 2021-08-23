<?php

namespace App\Services;

use App\Cnab\Parser;
use App\Cnab\Template\ByCodersCnab;
use Exception;

class CnabImporterService
{
    protected $parser;
    protected $template = 'default';

    public $templates = [
        'default' => ByCodersCnab::class
    ];

    /**
     * @throws Exception
     */
    public function import($content, $template = 'default'): array
    {
        $this->prepare($template);

        $result = [];
        foreach ($content as $line) {
            $result[] = $this->parser->parse($line);
        }
        return $result;
    }


    protected function prepare($template): void
    {
        $this->setTemplate($template);
        $this->parser = new Parser(app($this->resolveTemplate()));
    }

    public function resolveTemplate(): ?string
    {
        return $this->templates[$this->template] ?? null;
    }

    public function getTemplateClass(): ?string
    {
        return $this->resolveTemplate();
    }

    public function setTemplate($template): void
    {
        $this->template = $template;
    }
}
