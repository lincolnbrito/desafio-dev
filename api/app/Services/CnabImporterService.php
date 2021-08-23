<?php

namespace App\Services;

use App\Cnab\Parser;
use App\Cnab\Template\ByCodersCnab;
use Exception;

class CnabImporterService
{
    protected $ownerService;
    protected $storeService;
    protected $transactionService;

    protected $parser;
    protected $template = 'default';

    public $templates = [
        'default' => ByCodersCnab::class
    ];

    public function __construct(
        OwnerService $ownerService,
        StoreService $storeService,
        TransactionService $transactionService
    )
    {
        $this->ownerService = $ownerService;
        $this->storeService = $storeService;
        $this->transactionService = $transactionService;
    }

    /**
     * @throws Exception
     */
    public function import($content, $template = 'default')
    {
        $this->prepare($template);

        foreach ($content as $line) {
            $parsed = $this->parser->parse($line);
            $owner = $this->ownerService->import($parsed['owner']);
            $store = $this->storeService->import($parsed['store'], $owner);
        }

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
