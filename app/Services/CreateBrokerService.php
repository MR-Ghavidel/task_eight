<?php

namespace App\Services;


use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;

class CreateBrokerService
{
    public function __construct(
        private readonly BrokerRepositoryInterface $brokerRepository,
        private readonly BrokerPropertyRepositoryInterface  $brokerPropertyRepository,
        private readonly BrokerCommentRepositoryInterface $brokerCommentRepository,
        private readonly BrokerReactionRepositoryInterface $brokerReactionRepository
    )
    {
    }

    public function createBrokerWithTables(array $data)
    {
        //dd($data);
        $brokerId = $this->brokerRepository->create($data);
        $this->brokerPropertyRepository->createSchemaByBrokerId($brokerId);
        $this->brokerCommentRepository->createSchemaByBrokerId($brokerId);
        $this->brokerReactionRepository->createSchemaByBrokerId($brokerId);
        return $brokerId;
    }
}
