<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use App\Repository\UserRepository;
use App\Repository\VehicleTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly VehicleTypeRepository $typeRepository, private readonly UserRepository $userRepository)
    {
    }

    public function load(ObjectManager $manager)
    {
//        $faker = Factory::create('fr_FR');
//        $types = $this->typeRepository->findAll();
//        $users = $this->userRepository->findAll();
//        for ($v = 0; $v < 100; $v++) {
//            $vehicle = new Vehicle();
//            $vehicle
//                ->setBrand($faker->word())
//                ->setModel($faker->word())
//                ->setYear($faker->numberBetween(2000, 2020))
//                ->setPrice($faker->numberBetween(1000, 45000))
//                ->setMilliage($faker->randomFloat(1, 10000, 350000))
//                ->setImage("https://picsum.photos/id/" . mt_rand(1, 100) . "/640/426")
//                ->setVehicleType($types[mt_rand(0, count($types) - 1)])
//                ->setUser($users[mt_rand(0, count($users) - 1)])
//                ->setDescription($faker->paragraphs(mt_rand(1, 3), true))
//                ->setCreatedAt(new \DateTimeImmutable())
//                ;
//            $manager->persist($vehicle );
//        }
//        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
//            VehicleTypeFixtures::class,
            UserFixtures::class
        ];
    }
}