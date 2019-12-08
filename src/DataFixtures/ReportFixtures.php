<?php

namespace App\DataFixtures;

use App\Entity\Report;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ReportFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // on créé 6 liens de rapports
        for ($i = 0; $i < 5; $i++) {
            $report = new Report();
            $report->setTitle($faker->text(15));
            $report->setMeetingDate($faker->dateTime);
            $report->setLink($faker->url);
            $manager->persist($report);
        }
        $manager->flush();
    }
}
