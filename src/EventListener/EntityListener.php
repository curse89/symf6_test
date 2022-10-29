<?php

namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityListener
{
    public function __construct(public ValidatorInterface $validator)
    {

    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        $e = $this->validator->validate($entity);
        if ($e->has(0)) {
            throw new \Exception('Error');
        }
    }
}