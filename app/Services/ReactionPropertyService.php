<?php

namespace App\Services;


use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\General\Interface\UserRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;
use App\Validators\PropertyExistValidator;
use App\Validators\UserExistValidator;

class ReactionPropertyService
{
    public function __construct(
        private readonly PropertyRepositoryInterface       $propertyRepository,
        private readonly UserRepositoryInterface           $userRepository,
        private readonly BrokerReactionRepositoryInterface $reactionRepository,
    )
    {
    }

    public function likeProperty(array $data): array
    {
        $property = $this->propertyRepository->getOneById($data['property_id']);

        (new PropertyExistValidator())->validate(property: $property);

        $user = $this->userRepository->findById($data['user_id']);

        (new UserExistValidator())->validate(user: $user);

        $isReacted = $this->reactionRepository->isReacted(
            propertyId: $property->id,
            userId: $user->id,
            brokerId: $property->brokerId
        );

        if ($isReacted) {
            return ['message' => 'You have already reacted this property'];
        }

        $this->reactionRepository->createByBrokerId(
            data: [
                'property_id' => $property->id,
                'user_id' => $user->id,
                'is_liked' => $data['is_liked'],
            ],
            brokerId: $property->brokerId
        );

        return ['message' => 'Property liked'];
    }
}
