<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $faker = Factory::create('fr_FR');
//        for ($m = 0; $m < 15; $m++) {
//            $message = new Message();
//            $message
//                ->setName($faker->lastName())
//                ->setFirstname($faker->firstName())
//                ->setEmail($faker->freeEmail())
//                ->setPhone($faker->e164phoneNumber())
//                ->setSubject($faker->sentence())
//                ->setMessage($faker->realText())
//                ->setCreatedAt(new \DateTimeImmutable());
//
//            $manager->persist($message);
//
//        }
//
//        $manager->flush();
    }
}
