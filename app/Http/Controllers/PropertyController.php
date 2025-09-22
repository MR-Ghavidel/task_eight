<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProperyStatusRequest;
use App\Http\Requests\CreatePropertyRequest;
use App\Http\Resources\ShowPropertyResource;
use App\Repository\General\PropertyRepository;
use App\Services\ChangePropertyStatusService;
use App\Services\CreatePropertyService;
use App\Services\ViewPropertyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    public function __construct(
        private readonly CreatePropertyService       $createPropertyService,
        private readonly ViewPropertyService         $viewPropertyService,
        private readonly PropertyRepository          $propertyRepository,
        private readonly ChangePropertyStatusService $changePropertyStatusService
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function create(CreatePropertyRequest $request): JsonResponse
    {
        return response()->json($this->createPropertyService->createProperty($request->validated()), Response::HTTP_CREATED);
    }

    public function viewOneById(int $id, int $userId): ShowPropertyResource
    {
        return new ShowPropertyResource($this->viewPropertyService->viewPropertyById($id, $userId));
    }

    public function getAll(int $perPage, int $page): AnonymousResourceCollection
    {
        return ShowPropertyResource::collection($this->propertyRepository->getAll(perPage: $perPage, page: $page));
    }

    /**
     * @throws \Throwable
     */
    public function changeStatus(ChangeProperyStatusRequest $request): JsonResponse
    {
        return response()->json($this->changePropertyStatusService->changePropertyStatus($request->validated()));
    }
}
