<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CarouselFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $carousel = new Carousel();
            $carousel->setTitle($faker->sentence);
            $carousel->setPicture($faker->imageUrl());
            $carousel->setDescription($faker->text);
            $manager->persist($carousel);
        }

        $manager->flush();
    }
}
