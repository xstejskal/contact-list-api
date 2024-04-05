<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\ErrorType;
use App\GraphQL\Types\OutputErrorType;
use App\GraphQL\Types\RemoveContactInput;
use App\GraphQL\Types\RemoveContactOutput;
use App\Model\ContactRepository;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Field\ResolvableField;

class RemoveContactMutation
{
    public function __construct(
        protected ContactRepository $contactRepository,
        protected RemoveContactOutput $removeContactOutput,
    ) {
    }


    public function getField(): ResolvableField
    {
        return ResolvableField::create(
            name: 'removeContact',
            type: $this->removeContactOutput,
            resolveFn: fn($parent, object $input): array|bool => $this->resolve($input),
        )->setArguments(new ArgumentSet([
            new Argument(
                name: 'input',
                type: (new RemoveContactInput()),
            ),
        ]));
    }

    protected function resolve(object $input): array|bool
    {
        $row = $this->contactRepository->delete((int) $input->id);
        return $row ?: [ErrorType::create('Failed to delete contact')];
    }

}