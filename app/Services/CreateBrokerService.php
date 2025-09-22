<?php

namespace App\Services;


use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\TenantTablesGenerator;
use App\Validators\BrokerTablesExistValidator;

class CreateBrokerService
{
    public function __construct(
        private readonly BrokerRepositoryInterface $brokerRepository,
        private readonly TenantTablesGenerator     $tenantTablesGenerator,
    )
    {
    }

    public function createBrokerWithTables(array $data): array
    {
        $brokerId = $this->brokerRepository->create($data);

        $this->tenantTablesGenerator->createPropertyTableByBrokerId($brokerId);

        $this->tenantTablesGenerator->createPropertyViewTableByBrokerId($brokerId);

        $this->tenantTablesGenerator->createCommandTableByBrokerId($brokerId);

        $this->tenantTablesGenerator->createReactionTableByBrokerId($brokerId);

        (new BrokerTablesExistValidator())->validate(brokerId: $brokerId);

        return ['broker_id' => $brokerId];
    }


}
