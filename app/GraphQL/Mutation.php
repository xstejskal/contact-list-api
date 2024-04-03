<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\GraphQL\Mutations\CreateContactMutation;
use App\GraphQL\Mutations\RemoveContactMutation;
use App\GraphQL\Mutations\UpdateContactMutation;
use Graphpinator\Typesystem\Field\ResolvableFieldSet;
use Graphpinator\Typesystem\InterfaceSet;

final class Mutation extends AbstractType
{
    protected const NAME = 'Mutation';


    public function __construct(
        protected CreateContactMutation $createContactMutation,
        protected UpdateContactMutation $updateContactMutation,
        protected RemoveContactMutation $removeContactMutation,
        InterfaceSet $implements = new InterfaceSet([]),
    )
    {
        parent::__construct($implements);
    }


    protected function getFieldDefinition(): ResolvableFieldSet
    {
        $fields = [
            $this->createContactMutation->getField(),
            $this->updateContactMutation->getField(),
            $this->removeContactMutation->getField(),
        ];

        return new ResolvableFieldSet($fields);
    }
}