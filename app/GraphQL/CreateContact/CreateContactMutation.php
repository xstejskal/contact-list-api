<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\CreateContactInput;
use App\GraphQL\Types\CreateContactOutput;
use App\GraphQL\Types\ErrorType;
use App\GraphQL\Types\OutputErrorType;
use App\Model\ContactRepository;
use Dibi\Row;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Field\ResolvableField;

class CreateContactMutation
{
    public function __construct(
        protected ContactRepository $contactRepository,
        protected CreateContactOutput $createContactOutput,
    ) {
    }


    public function getField(): ResolvableField
    {
        return ResolvableField::create(
            name: 'createContact',
            type: $this->createContactOutput,
            resolveFn: fn($parent, object $input): array|Row => $this->resolve($input),
        )->setArguments(new ArgumentSet([
            new Argument(
                name: 'input',
                type: (new CreateContactInput()),
            ),
        ]));
    }

    protected function resolve(object $input): array|Row
    {
        $row = $this->contactRepository->create((array) $input);
        return $row ?: [ErrorType::create('Failed to create contact')];
    }

}