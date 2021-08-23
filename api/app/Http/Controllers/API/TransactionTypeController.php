<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionTypeResource;
use App\Services\TransactionTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionTypeController extends Controller
{
    protected $service;

    public function __construct(TransactionTypeService $service) {
        $this->service = $service;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        try{
            $transaction_types = $this->service->paginate(30);

            return TransactionTypeResource::collection($transaction_types);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return TransactionTypeResource
     */
    public function show($id): TransactionTypeResource
    {
        $transaction_trype = $this->service->find($id);
        return new TransactionTypeResource($transaction_trype);
    }

}
