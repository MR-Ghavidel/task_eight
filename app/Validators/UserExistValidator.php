<?php

namespace App\Validators;

class UserExistValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $user = $args['user'];

        if ($user === null) {
            throw new \RuntimeException('User not found');
        }
    }
}
