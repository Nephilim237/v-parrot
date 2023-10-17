<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user = new User();
        $user->setFullname("Vincent Parrot")
            ->setEmail('vparrot@gmail.com')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->hasher->hashPassword($user, '1234567890'))
            ->setCreatedAt(new \DateTimeImmutable())
        ;
        $manager->persist($user);

//
//        for ($u = 0; $u < 10; $u++) {
//            $user = new User();
//
//            $user
//                ->setFullname($faker->name())
//                ->setEmail($faker->companyEmail)
//                ->setCreatedAt(new \DateTimeImmutable())
//                ->setPassword($this->hasher->hashPassword($user, '1234567890'))
//                ->setCreatedAt(new \DateTimeImmutable())
//            ;
//            $manager->persist($user);
//        }

        $manager->flush();
    }
}
