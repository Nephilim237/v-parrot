<?php

namespace App\EntityListener;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Vehicle::class)]
class VehicleEntityListener
{

    public function __construct(private readonly SluggerInterface $slugger)
    {

    }

    public function prePersist(Vehicle $vehicle, LifecycleEventArgs $eventArgs): void
    {
        $vehicle->computeSlug($this->slugger);
    }

}