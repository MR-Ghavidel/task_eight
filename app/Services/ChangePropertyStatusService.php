<?php

namespace App\Services;


use App\Enums\PropertyStatus;
use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Validators\BrokerExistValidator;
use App\Validators\BrokerTablesExistValidator;
use App\Validators\PropertyExistValidator;
use App\Validators\PropertyOwnerValidator;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\DB;

class ChangePropertyStatusService
{
    public function __construct(
        private readonly BrokerPropertyRepositoryInterface $brokerPropertyRepository,
        private readonly PropertyRepositoryInterface       $propertyRepository,
        private readonly BrokerRepositoryInterface         $brokerRepository
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function changePropertyStatus(array $data): array
    {
        $broker = $this->brokerRepository->findById($data['broker_id']);

        (new BrokerExistValidator())->validate(broker: $broker);

        (new BrokerTablesExistValidator())->validate(brokerId: $broker->id);

        $property = $this->propertyRepository->getOneById($data['property_id']);

        (new PropertyExistValidator())->validate(property: $property);

        (new PropertyOwnerValidator())->validate(property: $property, brokerId: $broker->id);

        if (!in_array($data['new_status'], PropertyStatus::getValues(), true)) {
            throw new RuntimeException('status not allowed');
        }

        if ($data['new_status'] === $property->status) {
            throw new \RuntimeException("property status already $property->status");
        }

        DB::transaction(function () use ($data, $property, $broker) {

            $this->propertyRepository->updateStatus(id: $property->id, status: $data['new_status']);

            $this->brokerPropertyRepository->updateStatus(brokerId: $broker->id, propertyId: $property->id, status: $data['new_status']);

        });

        return ['message' => 'Property status successfully changed'];
    }


}
