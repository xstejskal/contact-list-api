<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;


final class RemoveContactInput extends InputType
{
    protected const NAME = 'RemoveContactInput';


    protected function getFieldDefinition(): ArgumentSet
    {
        return new ArgumentSet([
            new Argument(
                name: 'id',
                type: Container::ID()->notNull(),
            ),
        ]);
    }
}