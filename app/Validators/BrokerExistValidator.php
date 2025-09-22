<?php

namespace App\Validators;

class BrokerExistValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $broker = $args['broker'];

        if ($broker === null) {
            throw new \RuntimeException('Broker not found');
        }
    }
}
