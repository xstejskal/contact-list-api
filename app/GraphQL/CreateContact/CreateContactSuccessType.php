<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Dibi\Row;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

final class CreateContactSuccessType extends AbstractType
{
    protected const NAME = 'CreateContactSuccess';

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
