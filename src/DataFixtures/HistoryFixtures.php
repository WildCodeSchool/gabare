<?php

namespace App\DataFixtures;

use App\Entity\History;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class HistoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $historic = new History();
        $faker = Faker\Factory::create('fr_FR');
        $historic->setTitle($faker->sentence);
        $historic->setDescription($faker->text(400));
        $historic->setImageName('');
        $historic->setUpdatedAt($faker->DateTime());
        $manager->persist($historic);
        $manager->flush();
    }
}
