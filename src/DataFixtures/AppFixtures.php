<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Presse;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $press = new Presse();
        $faker = Faker\Factory::create('fr_FR');
        $press->setTitle($faker->sentence);
        $press->setImage($faker->imageUrl());
        $press->setResume($faker->text);
        $press->setLien($faker->url);
        $manager->persist($press);
        $manager->flush();
    }
}
