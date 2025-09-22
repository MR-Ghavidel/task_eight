<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeProperyStatusRequest;
use App\Http\Requests\CreatePropertyRequest;
use App\Http\Resources\ShowPropertyResource;
use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\General\PropertyFeatureRepository;
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
        private readonly PropertyRepositoryInterface $propertyRepository,
        private readonly ChangePropertyStatusService $changePropertyStatusService,
        private readonly PropertyFeatureRepository   $propertyFeatureRepository,
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
        $properties = $this->propertyRepository->getAll(perPage: $perPage, page: $page);

        $propertyIds = collect($properties)->pluck('id')->toArray();

        $propertyFeature = $this->propertyFeatureRepository->getAllByIds($propertyIds);

        $properties = collect($properties)->each(function ($property) use ($propertyFeature) {
            $property->features = collect($propertyFeature)->where('property_id', $property->id)->values()->toArray();
        });

        return ShowPropertyResource::collection($properties);
    }

    /**
     * @throws \Throwable
     */
    public function changeStatus(ChangeProperyStatusRequest $request): JsonResponse
    {
        return response()->json($this->changePropertyStatusService->changePropertyStatus($request->validated()));
    }
}
