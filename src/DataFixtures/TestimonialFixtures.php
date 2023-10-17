<?php

namespace App\DataFixtures;

use App\Entity\Testimonial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TestimonialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $faker = Factory::create('fr_FR');
//
//        for ($t = 0; $t < 10; $t++) {
//            $testy = new Testimonial();
//            $testy->setName($faker->name())
//                ->setComment($faker->realTextBetween(160, 300, 2))
//                ->setInFront($faker->randomElement([0, 1]))
//                ->setRate($faker->randomElement([1, 5]));
//
//            $manager->persist($testy);
//        }
//
//        $manager->flush();
    }
}
