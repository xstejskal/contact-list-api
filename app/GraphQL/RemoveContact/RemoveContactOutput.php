<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\Typesystem\TypeSet;
use Graphpinator\Typesystem\UnionType;
use Graphpinator\Value\TypeIntermediateValue;


final class RemoveContactOutput extends UnionType
{
    protected const NAME = 'RemoveContactOutput';

    public function __construct(
        RemoveContactConfirmType $removeContactConfirmType,
        RemoveContactErrorType $removeContactErrorType,
    )
    {
        parent::__construct(new TypeSet([
            $removeContactConfirmType,
            $removeContactErrorType,
        ]));
    }

    public function createResolvedValue(mixed $rawValue): TypeIntermediateValue
    {
        if ($rawValue === true) {
            return new TypeIntermediateValue(new RemoveContactConfirmType(status: true), $rawValue);
        }

        return new TypeIntermediateValue(new RemoveContactErrorType(status: false, errors: $rawValue), $rawValue);
    }
}
