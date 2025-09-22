<?php

namespace App\Validators;

use App\Enums\PropertySaleTypes;
use App\Enums\PropertyTypes;
use http\Exception\RuntimeException;

class PropertyArgsValidator implements BusinessRuleValidator
{

    public function validate(...$args): void
    {
        $data = $args['data'];

        if ($data['area'] <= 0) {
            throw new RuntimeException('area must be greater than 0');
        }

        if (!in_array($data['sale_type'], PropertySaleTypes::values(), true)) {
            throw new \RuntimeException('sale type must be one of: ' . implode(', ', PropertySaleTypes::values()));
        }

        if ($data['price'] <= 0)
        {
            throw new \RuntimeException('price must be greater than 0');
        }

        if (!in_array($data['type'], PropertyTypes::values(), true)) {
            throw new \RuntimeException('type must be one of: ' . implode(', ', PropertyTypes::values()));
        }

        if ($data['floor'] > $data['total_floors'])
        {
            throw new \RuntimeException('floor must be smaller than or equal with total floors');
        }

        if ($data['type'] === PropertyTypes::VILLA->value)
        {
            if ($data['total_floors'] !== $data['floor'])
            {
                throw new \RuntimeException('total floors must be equal with total floors');
            }

            if ($data['floor'] > 1)
            {
                throw new \RuntimeException('you chose floor greater than 1 but type of property is Villa');
            }

            if ($data['total_floors'] > 1)
            {
                throw new \RuntimeException('you chose total floor greater than 1 but type of property is Villa');
            }
        }
    }
}
