<?php
namespace App\EventSubscriber;

use App\Entity\Message;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\Vehicle;
use App\Entity\VehicleType;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (
            !$entity instanceof Vehicle &&
            !$entity instanceof VehicleType &&
            !$entity instanceof User &&
            !$entity instanceof Message &&
            !$entity instanceof Service ) {
            return;
        }

        $entity->setCreatedAt(new \DateTimeImmutable());
    }
}