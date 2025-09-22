<?php

namespace App\Services;


use App\Enums\PropertyStatus;
use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\General\Interface\PropertyFeatureRepositoryInterface;
use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Validators\BrokerExistValidator;
use App\Validators\BrokerTablesExistValidator;
use App\Validators\PropertyArgsValidator;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\DB;

class CreatePropertyService
{
    public function __construct(
        private readonly BrokerRepositoryInterface          $brokerRepository,
        private readonly BrokerPropertyRepositoryInterface  $brokerPropertyRepository,
        private readonly PropertyRepositoryInterface        $propertyRepository,
        private readonly PropertyFeatureRepositoryInterface $propertyFeatureRepository,
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function createProperty(array $data): array
    {
        $features = $data['features'];

        unset($data['features']);

        $broker = $this->brokerRepository->findById($data['broker_id']);

        (new BrokerExistValidator())->validate(broker: $broker);

        (new BrokerTablesExistValidator())->validate(brokerId: $broker->id);

        (new PropertyArgsValidator())->validate(data: $data);

        $propertyId = 0;

        DB::transaction(function () use ($features, $broker, $data, &$propertyId) {

            $propertyId = $this->propertyRepository->create($data);

            $this->createPropertyFeature($features, $propertyId);

            $this->brokerPropertyRepository->createByBrokerId(
                data: [
                    'property_id' => $propertyId,
                    'property_title' => $data['title'],
                    'property_description' => $data['description'],
                    'status' => PropertyStatus::ACTIVE->value,
                ],
                brokerId: $broker->id
            );
        });

        return ['property_id' => $propertyId];
    }

    private function createPropertyFeature(array $data, int $propertyId): void
    {
        $features = [];

        foreach ($data as $feature) {
            $features[] = [
                'name' => $feature,
                'property_id' => $propertyId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $saveFeaturesResult = $this->propertyFeatureRepository->create($features);

        if (!$saveFeaturesResult) {
            throw new RuntimeException('Failed to create property feature');
        }
    }
}
