<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

class StatusType extends AbstractType
{
    protected const NAME = 'Status';

    public function __construct(
        public bool $status = false,
        public array $errors = [],
    ) {
        parent::__construct();
    }

    protected function getFieldDefinition(): ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            new ResolvableField(
                name: 'status',
                type: Container::Boolean(),
                resolveFn: fn(): bool => $this->status,
            ),
            new ResolvableField(
                name: 'errors',
                type: (new ErrorType())->notNullList(),
                resolveFn: fn(): array => $this->errors,
            ),
        ]);
    }
}
