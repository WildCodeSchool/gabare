<?php

namespace App\DataFixtures;

use App\Entity\Capital;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CapitalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $capital = new Capital();
            $capital->setNumber($faker->numberBetween(0, 9000));
            $capital->setTitle($faker->sentence);
            $manager->persist($capital);
        }
        $manager->flush();
    }
}
