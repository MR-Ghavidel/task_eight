<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrokerRequest;
use App\Http\Resources\BrokerPropertyDetailsResource;
use App\Http\Resources\BrokerPropertyDetailsResourceCollection;
use App\Services\CreateBrokerService;
use App\Services\ShowBrokerPropertyDetailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class BrokerController extends Controller
{
    public function __construct(
        private readonly CreateBrokerService             $createBrokerService,
        private readonly ShowBrokerPropertyDetailService $showBrokerPropertyDetailService
    )
    {
    }

    public function create(CreateBrokerRequest $request): JsonResponse
    {
        return response()->json($this->createBrokerService->createBrokerWithTables($request->validated()), Response::HTTP_CREATED);
    }

    public function getPropertyDetailById(int $brokerId, int $propertyId): BrokerPropertyDetailsResource
    {
        return new BrokerPropertyDetailsResource(
            $this->showBrokerPropertyDetailService->getPropertyDetailById(brokerId: $brokerId, propertyId: $propertyId)
        );
    }

    public function getAllPropertiesDetailsByBrokerId(int $brokerId, int $perPage, int $page)
    : BrokerPropertyDetailsResourceCollection
    {
        return new BrokerPropertyDetailsResourceCollection($this->showBrokerPropertyDetailService->getAllPropertiesDetailByBrokerId(
            brokerId: $brokerId,
            perPage: $perPage,
            page: $page
        ));
    }
}
