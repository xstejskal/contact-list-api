<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\ErrorType;
use App\GraphQL\Types\OutputErrorType;
use App\GraphQL\Types\UpdateContactInput;
use App\GraphQL\Types\UpdateContactOutput;
use App\Model\ContactRepository;
use App\ORM\Repository\DivisionRepository;
use App\ORM\Repository\ProductRepository;
use Dibi\Row;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Field\ResolvableField;
use LeanMapper\Entity;

class UpdateContactMutation
{
    public function __construct(
        protected ContactRepository $contactRepository,
        protected UpdateContactOutput $updateContactOutput,
    ) {
    }


    public function getField(): ResolvableField
    {
        return ResolvableField::create(
            name: 'updateContact',
            type: $this->updateContactOutput,
            resolveFn: fn($parent, object $input): array|Row => $this->resolve($input),
        )->setArguments(new ArgumentSet([
            new Argument(
                name: 'input',
                type: (new UpdateContactInput()),
            ),
        ]));
    }

    protected function resolve(object $input): array|Row
    {
        $row = $this->contactRepository->update((int) $input->id, (array) $input);
        return $row ?: [ErrorType::create('Failed to update contact')];
    }

}