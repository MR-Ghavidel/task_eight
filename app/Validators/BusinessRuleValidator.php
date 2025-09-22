<?php

namespace App\Validators;

interface BusinessRuleValidator
{
    public function validate(...$args): void;
}
