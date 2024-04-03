<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

class ErrorType extends AbstractType
{
    protected const NAME = 'Error';

    protected string $message;

    public static function create(
        string $message,
    ): self {
        $error = new self();
        $error->message = $message;
        return $error;
    }


    protected function getFieldDefinition(): ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            new ResolvableField(
                name: 'message',
                type: Container::String()->notNull(),
                resolveFn: fn(self $error): string => $error->message,
            ),
        ]);
    }
}