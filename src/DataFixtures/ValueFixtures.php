<?php

namespace App\DataFixtures;

use App\Entity\Value;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ValueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $value = new Value();
            $value->setNumber($faker->numberBetween(0, 9000));
            $value->setTitle($faker->sentence);
            $manager->persist($value);
        }
        $manager->flush();
    }
}
