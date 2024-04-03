<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Dibi\Row;
use Graphpinator\Typesystem\TypeSet;
use Graphpinator\Typesystem\UnionType;
use Graphpinator\Value\TypeIntermediateValue;


final class UpdateContactOutput extends UnionType
{
    protected const NAME = 'UpdateContactOutput';

    public function __construct(
        private UpdateContactSuccessType $updateContactSuccessType,
        private UpdateContactErrorType $updateContactErrorType,
    )
    {
        parent::__construct(new TypeSet([
            $updateContactSuccessType,
            $updateContactErrorType,
        ]));
    }

    public function createResolvedValue(mixed $rawValue): TypeIntermediateValue
    {
        if ($rawValue instanceof Row) {
            return new TypeIntermediateValue($this->updateContactSuccessType, $rawValue);
        }

        return new TypeIntermediateValue(new UpdateContactErrorType(status: false, errors: $rawValue), $rawValue);
    }
}
