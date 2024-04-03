<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Graphpinator\ExtraTypes\EmailAddressType;
use Graphpinator\ExtraTypes\PhoneNumberType;
use Graphpinator\Typesystem\Argument\Argument;
use Graphpinator\Typesystem\Argument\ArgumentSet;
use Graphpinator\Typesystem\Container;
use Graphpinator\Typesystem\InputType;


final class UpdateContactInput extends InputType
{
    protected const NAME = 'UpdateContactInput';


    protected function getFieldDefinition(): ArgumentSet
    {
        return new ArgumentSet([
            new Argument(
                name: 'id',
                type: Container::ID()->notNull(),
            ),
            new Argument(
                name: 'firstname',
                type: Container::String(),
            ),
            new Argument(
                name: 'lastname',
                type: Container::String(),
            ),
            new Argument(
                name: 'company',
                type: Container::String(),
            ),
            new Argument(
                name: 'email',
                type: new EmailAddressType(),
            ),
            (new Argument(
                name: 'phones',
                type: (new PhoneNumberType())->list(),
            ))->setDescription('List of phone numbers in format +{1}[0-9]{1,3}[0-9]{8,9}.'),
        ]);
    }
}