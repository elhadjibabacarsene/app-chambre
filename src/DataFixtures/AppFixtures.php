<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create("FR_fr");

        $user = new User();
        $user->setUsername($faker->userName)
            ->setPassword('password')
            ->setName($faker->name)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $manager->flush();

    }
}
