<?php

namespace App\Validators;

class PropertyOwnerValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $property = $args['property'];
        $brokerId = $args['brokerId'];

        if ($property->brokerId !== $brokerId) {
            throw new \RuntimeException('The Property not for this broker');
        }
    }
}
