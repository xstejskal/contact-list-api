<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\Typesystem\Type;

abstract class AbstractType extends Type
{
    public function validateNonNullValue(mixed $rawValue): bool
    {
        return true;
    }
}