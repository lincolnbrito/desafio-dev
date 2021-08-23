<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Services\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoreController extends Controller
{
    protected $service;

    public function __construct(StoreService $service) {
        $this->service = $service;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        try{
            $stores = $this->service->paginate(30);

            return StoreResource::collection($stores);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return StoreResource|JsonResponse
     */
    public function show($id)
    {
        $store = $this->service->find($id);
        return new StoreResource($store);
    }
}
