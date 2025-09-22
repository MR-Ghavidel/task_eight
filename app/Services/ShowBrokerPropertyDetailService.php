<?php

namespace App\Services;


use App\Entities\BrokerPropertyEntity;
use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyViewRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;
use App\Validators\BrokerExistValidator;
use App\Validators\BrokerTablesExistValidator;
use App\Validators\PropertyExistValidator;

class ShowBrokerPropertyDetailService
{
    public function __construct(
        private readonly BrokerRepositoryInterface             $brokerRepository,
        private readonly BrokerPropertyRepositoryInterface     $brokerPropertyRepository,
        private readonly BrokerPropertyViewRepositoryInterface $brokerPropertyViewRepository,
        private readonly BrokerReactionRepositoryInterface     $brokerReactionRepository,
    )
    {
    }

    public function getPropertyDetailById(int $brokerId, int $propertyId): BrokerPropertyEntity
    {
        $broker = $this->brokerRepository->findById($brokerId);

        (new BrokerExistValidator())->validate(broker: $broker);

        (new BrokerTablesExistValidator())->validate(brokerId: $broker->id);

        $brokerProperty = $this->brokerPropertyRepository->getOneById(propertyId: $propertyId, brokerId: $broker->id);

        (new PropertyExistValidator())->validate(property: $brokerProperty);

        $brokerProperty->viewCount = $this->brokerPropertyViewRepository->viewCountByPropertyIdAndBrokerId(brokerId: $broker->id, propertyId: $propertyId);

        $brokerProperty->likeCount = $this->brokerReactionRepository->likeCountByPropertyIdAndBrokerId(propertyId: $propertyId, brokerId: $broker->id);

        $brokerProperty->dislikeCount = $this->brokerReactionRepository->disLikeCountByPropertyIdAndBrokerId(propertyId: $propertyId, brokerId: $broker->id);

        return $brokerProperty;
    }

    public function getAllPropertiesDetailByBrokerId(int $brokerId, int $perPage, int $page): array
    {
        $broker = $this->brokerRepository->findById($brokerId);

        (new BrokerExistValidator())->validate(broker: $broker);

        (new BrokerTablesExistValidator())->validate(brokerId: $broker->id);

        $brokerProperties = $this->brokerPropertyRepository->getAllPropertiesByBrokerId(
            brokerId: $brokerId,
            perPage: $perPage,
            page: $page
        );

        $brokerPropertyViews = $this->brokerPropertyViewRepository->getAllViewsByBrokerId($brokerId);

        $brokerPropertyReactions = $this->brokerReactionRepository->getAllReactionsByBrokerId($brokerId);

        $finalBrokerProperties = collect($brokerProperties)->each(function (BrokerPropertyEntity $property) use ($brokerPropertyViews, $brokerPropertyReactions) {

            $viewCount = collect($brokerPropertyViews)
                ->where('propertyId', '=', $property->propertyId)
                ->select(['ip', 'userId'])
                ->unique()
                ->count();

            $likeCount = collect($brokerPropertyReactions)
                ->where('propertyId', '=', $property->propertyId)
                ->where('isLiked', '=', true)
                ->count();

            $dislikeCount = collect($brokerPropertyReactions)
                ->where('propertyId', '=', $property->propertyId)
                ->where('isLiked', '=', false)
                ->count();

            $property->viewCount = $viewCount;
            $property->likeCount = $likeCount;
            $property->dislikeCount = $dislikeCount;
        });

        return $finalBrokerProperties->toArray();
    }

}
