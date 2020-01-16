<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CarouselFixtures extends Fixture
{
    const LINKS = [
        "https://127.0.0.1:8000/la-vie-de-la-gabare#actualites-de-la-gabare",
        "https://127.0.0.1:8000/nous-rejoindre#bulletion-adhesion",
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $carousel = new Carousel();
            if (array_key_exists($i, self::LINKS)) {
                $carousel->setLink(self::LINKS[$i]);
            }
            $carousel->setTitle($faker->sentence(6, true));
            $carousel->setUpdatedAt($faker->DateTime());
            $carousel->setImageName('');
            $carousel->setDescription($faker->text);
            $manager->persist($carousel);
        }

        $manager->flush();
    }
}
