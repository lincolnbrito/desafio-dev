<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OwnerResource;
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
            $owners = $this->service->paginate(30);

            return OwnerResource::collection($owners);
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
    public function show($id): OwnerResource
    {
        $owner = $this->service->find($id);
        return new OwnerResource($owner);
    }

}
