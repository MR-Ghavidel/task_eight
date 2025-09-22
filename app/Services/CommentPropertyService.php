<?php

namespace App\Services;


use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\General\Interface\UserRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;
use App\Validators\PropertyExistValidator;
use App\Validators\UserExistValidator;

class CommentPropertyService
{
    public function __construct(
        private readonly PropertyRepositoryInterface      $propertyRepository,
        private readonly UserRepositoryInterface          $userRepository,
        private readonly BrokerCommentRepositoryInterface $brokerCommentRepository,
    )
    {
    }

    public function commentProperty(array $data): array
    {

        $property = $this->propertyRepository->getOneById($data['property_id']);

        (new PropertyExistValidator())->validate(property: $property);

        $user = $this->userRepository->findById($data['user_id']);

        (new UserExistValidator())->validate(user: $user);

        $this->brokerCommentRepository->createByBrokerId(
            data: [
                'property_id' => $property->id,
                'user_id' => $user->id,
                'text' => $data['text'],
            ],
            brokerId: $property->brokerId,
        );

        return ['message' => 'comment placed successfully'];
    }

}
