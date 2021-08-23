<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Resources\TransactionResource;
use App\Services\StoreService;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoreTransactionController extends Controller
{
    protected $service;
    protected $transactionService;

    public function __construct(
        StoreService $service,
        TransactionService $transactionService
    ) {
        $this->service = $service;
        $this->transactionService = $transactionService;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index($storeId)
    {
        try{
            $store = $this->service->find($storeId);
            $transactions = $this->transactionService->findByStore($store->id);

            return TransactionResource::collection($transactions);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $storeId
     * @param $id
     * @return TransactionResource
     */
    public function show($storeId, $id): TransactionResource
    {
        $store = $this->transactionService->find($id);
        return new TransactionResource($store);
    }
}
