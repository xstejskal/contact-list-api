<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Model\ContactRepository;
use Dibi\Row;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\InterfaceSet;

final class Query extends AbstractType
{
    protected const NAME = 'Query';


    public function __construct(
        protected ContactRepository $contactRepository,
        InterfaceSet $implements = new InterfaceSet([]),
    ) {
        parent::__construct($implements);
    }


    protected function getFieldDefinition(): ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                name: 'list',
                type: (new ContactType())->notNullList(),
                resolveFn: fn(): array => $this->contactRepository->find(),
            ),
            ResolvableField::create(
                name: 'detail',
                type: (new ContactType()),
                resolveFn: fn($parent, string $id): ?Row => $this->contactRepository->find(id: (int) $id),
            )->setArguments(new ArgumentSet([
                new Argument(
                    name: 'id',
                    type: Container::ID()->notNull(),
                ),
            ])),
            ResolvableField::create(
                name: 'search',
                type: (new ContactType())->notNullList(),
                resolveFn: fn($parent, string $query): array => $this->contactRepository->find(query: $query),
            )->setArguments(new ArgumentSet([
                new Argument(
                    name: 'query',
                    type: Container::String()->notNull(),
                ),
            ])),
        ]);
    }
}