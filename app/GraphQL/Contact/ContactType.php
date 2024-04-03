<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Dibi\Row;
use Graphpinator\ExtraTypes\EmailAddressType;
use Graphpinator\ExtraTypes\PhoneNumberType;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\Field\ResolvableField;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;

final class ContactType extends AbstractType
{
    protected const NAME = 'Contact';


    protected function getFieldDefinition(): ResolvableFieldSet
    {
        return new ResolvableFieldSet([
            ResolvableField::create(
                name: 'id',
                type: Container::ID()->notNull(),
                resolveFn: fn(Row $row): string => (string) $row->id,
            ),
            ResolvableField::create(
                name: 'firstname',
                type: Container::String()->notNull(),
                resolveFn: fn(Row $row): string => $row->firstname,
            ),
            ResolvableField::create(
                name: 'lastname',
                type: Container::String(),
                resolveFn: fn(Row $row): ?string => $row->lastname,
            ),
            ResolvableField::create(
                name: 'company',
                type: Container::String(),
                resolveFn: fn(Row $row): ?string => $row->company,
            ),
            ResolvableField::create(
                name: 'email',
                type: (new EmailAddressType()),
                resolveFn: fn(Row $row): ?string => $row->email,
            ),
            ResolvableField::create(
                name: 'phones',
                type: (new PhoneNumberType())->list(),
                resolveFn: fn(Row $row): array => $row->phones ? explode('|', $row->phones) : [],
            ),
        ]);
    }
}