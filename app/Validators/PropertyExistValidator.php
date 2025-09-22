<?php

namespace App\Validators;

class PropertyExistValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $property = $args['property'];

        if ($property === null) {
            throw new \RuntimeException('Property not found');
        }
    }
}
