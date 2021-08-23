<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Services\CnabImporterService;
use App\Services\ImportHistoryService;
use Illuminate\Http\JsonResponse;

class ImportController extends Controller
{
    protected $service;
    protected $importHistoryService;

    public function __construct(
        CnabImporterService $service,
        ImportHistoryService $importHistoryService

    ) {
        $this->service = $service;
        $this->importHistoryService = $importHistoryService;
    }

    /**
     * @param ImportFileRequest $request
     * @return JsonResponse
     */
    public function __invoke(ImportFileRequest $request): JsonResponse
    {
        $result = [];

        try{
            $file = $request->validated()['file'];

            $previous = $this->importHistoryService->find($file);

            if(!$previous) {
                $sanitizedData = array_filter(explode(PHP_EOL, $file->getContent()));
                $result = $this->service->import($sanitizedData);
                $this->importHistoryService->save($file);
            }

            return response()->json($result);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
