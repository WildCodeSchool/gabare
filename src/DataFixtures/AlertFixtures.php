<?php

namespace App\DataFixtures;

use App\Entity\Alert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AlertFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $alert = new Alert();
            $alert->setMessage($faker->sentence(10, true));
            $manager->persist($alert);
        }
        $manager->flush();
    }
}
