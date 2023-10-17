<?php

namespace App\DataFixtures;

use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
       foreach (['Diesel', 'Super', 'Electrique', 'Hybride'] as $e) {
           $type = new VehicleType();
           $type
               ->setType($e)
               ->setCreatedAt(new \DateTimeImmutable())
           ;
           $manager->persist($type);
       }

        $manager->flush();
    }
}
