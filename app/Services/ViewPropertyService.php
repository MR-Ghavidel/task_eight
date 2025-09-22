<?php

namespace App\Services;


use App\Entities\PropertyEntity;
use App\Repository\General\Interface\PropertyFeatureRepositoryInterface;
use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\General\Interface\UserRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyViewRepositoryInterface;
use App\Validators\PropertyExistValidator;
use App\Validators\UserExistValidator;

class ViewPropertyService
{
    public function __construct(
        private readonly PropertyRepositoryInterface           $propertyRepository,
        private readonly BrokerPropertyViewRepositoryInterface $brokerPropertyViewRepository,
        private readonly UserRepositoryInterface               $userRepository,
        private readonly PropertyFeatureRepositoryInterface    $propertyFeatureRepository,
    )
    {
    }

    public function viewPropertyById(int $id, int $userId): PropertyEntity
    {
        $property = $this->propertyRepository->getOneById($id);

        (new PropertyExistValidator())->validate(property: $property);

        $user = $this->userRepository->findById($userId);

        (new UserExistValidator)->validate(user: $user);

        $property->features = $this->propertyFeatureRepository->getByPropertyId($property->id);

        $this->brokerPropertyViewRepository->createByBrokerId(
            data: [
                'property_id' => $property->id,
                'user_id' => $user->id,
                'ip' => request()->ip(),
                'device' => request()->header('User-Agent'),
                'os' => request()->header('User-Agent'),
                'viewed_at' => now(),
            ],
            brokerId: $property->brokerId
        );

        return $property;
    }
}
