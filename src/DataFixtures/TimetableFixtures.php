<?php

namespace App\DataFixtures;

use App\Entity\Timetable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TimetableFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $timetable = new Timetable();
            $timetable->setVisitDate($faker->dateTimeBetween('-7 days', '+1 month', 'Europe/Paris'));
            $timetable->setVisitTime($faker->dateTime);
            $manager->persist($timetable);
        }
        $manager->flush();
    }
}
