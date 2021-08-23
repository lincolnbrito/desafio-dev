<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Services\CnabImporterService;

class ImportController extends Controller
{
    protected $service;

    public function __construct(CnabImporterService $service) {
        $this->service = $service;
    }

    /**
     * @param ImportFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(ImportFileRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $file = $request->validated();
            $sanitizedData = array_filter(explode(PHP_EOL, $file['file']->getContent()));

            $result = $this->service->import($sanitizedData);
            return response()->json($result);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
