<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Dibi\Row;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

final class UpdateContactSuccessType extends AbstractType
{
    protected const NAME = 'UpdateContactSuccess';

    protected function getFieldDefinition(): ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            new ResolvableField(
                name: 'contact',
                type: (new ContactType()),
                resolveFn: fn($parent): Row => $parent,
            ),
        ]);
    }
}
