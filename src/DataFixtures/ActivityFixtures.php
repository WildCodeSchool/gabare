<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityFixtures extends Fixture
{
    const ACTIVITY = [
        'Salarié',
        'Membre_CA',
        'Ami_CA',
        'Pionnier',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ACTIVITY as $key => $data) {
            $activities = new Activity();
            $activities->setName($data);
            $this->addReference('activities_' . $key, $activities);
            $manager->persist($activities);
        }
        $manager->flush();
    }
}
