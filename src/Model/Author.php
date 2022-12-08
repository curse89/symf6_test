<?php

namespace App\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Author
{
    public $firstName;

    /*
    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $fakeNames = ['test'];
        if (in_array($this->firstName, $fakeNames, true)) {
            $context->buildViolation('This name sounds totally fake!')
                ->atPath('firstName')
                ->addViolation();
        }
    }
    */

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $callback = function ($object, ExecutionContextInterface $context, $payload)
        {
            $fakeNames = ['test'];
            if (in_array($object->firstName, $fakeNames, true)) {
                $context->buildViolation('This name sounds totally fake!')
                    ->atPath('firstName')
                    ->addViolation();
            }
        };

        $metadata->addConstraint(new Assert\Callback($callback));
    }
}