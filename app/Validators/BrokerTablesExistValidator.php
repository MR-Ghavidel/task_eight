<?php

namespace App\Validators;

use Illuminate\Support\Facades\Schema;

class BrokerTablesExistValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $brokerId = $args['brokerId'];

        $suffix = 'broker_';
        $brokerPropertyTableName = $suffix . $brokerId . '_properties';
        $brokerPropertyViewTableName = $suffix . $brokerId . '_property_views';
        $brokerCommentTableName = $suffix . $brokerId . '_comments';
        $brokerReactionTableName = $suffix . $brokerId . '_reactions';

        if (!Schema::hasTable($brokerPropertyTableName)) {
            throw new \RuntimeException('Property table for broker ' . $brokerId . ' does not exist');
        }

        if (!Schema::hasTable($brokerPropertyViewTableName)) {
            throw new \RuntimeException('Property views table for broker ' . $brokerId . ' does not exist');
        }

        if (!Schema::hasTable($brokerCommentTableName)) {
            throw new \RuntimeException('Comments table for broker ' . $brokerId . ' does not exist');
        }

        if (!Schema::hasTable($brokerReactionTableName)) {
            throw new \RuntimeException('Reactions table for broker ' . $brokerId . ' does not exist');
        }
    }
}
