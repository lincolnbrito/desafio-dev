<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Store\OwnerResource;
use App\Services\OwnerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OwnerController extends Controller
{
    protected $service;

    public function __construct(OwnerService $service) {
        $this->service = $service;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index()
    {
        try{
            $stores = $this->service->paginate(30);

            return OwnerResource::collection($stores);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return OwnerResource
     */
    public function show($id)
    {
        $store = $this->service->find($id);
        return new OwnerResource($store);
    }

}
