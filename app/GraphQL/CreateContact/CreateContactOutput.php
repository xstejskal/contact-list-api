<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Dibi\Row;
use Graphpinator\Typesystem\TypeSet;
use Graphpinator\Typesystem\UnionType;
use Graphpinator\Value\TypeIntermediateValue;


final class CreateContactOutput extends UnionType
{
    protected const NAME = 'CreateContactOutput';

    public function __construct(
        private CreateContactSuccessType $createContactSuccessType,
        private CreateContactErrorType $createContactErrorType,
    )
    {
        parent::__construct(new TypeSet([
            $createContactSuccessType,
            $createContactErrorType,
        ]));
    }

    public function createResolvedValue(mixed $rawValue): TypeIntermediateValue
    {
        if ($rawValue instanceof Row) {
            return new TypeIntermediateValue($this->createContactSuccessType, $rawValue);
        }

        return new TypeIntermediateValue(new CreateContactErrorType(status: false, errors: $rawValue), $rawValue);
    }
}
