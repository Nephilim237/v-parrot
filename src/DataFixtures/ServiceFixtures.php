<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $faker = Factory::create('fr_FR');
//
//        for ($s = 0; $s < 5; $s++) {
//            $service = new Service();
//            $service
//                ->setTitle($faker->word())
//                ->setDescription($faker->realTextBetween(100, 120, 2))
//                ->setCreatedAt(new \DateTimeImmutable());
//            $manager->persist($service);
//
//        }
//
//        $manager->flush();
    }
}
