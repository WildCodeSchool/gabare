<?php

namespace App\DataFixtures;

use App\Entity\Alert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AlertFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
            $alert = new Alert();
            $alert->setMessage('Le magasin est fermé pendant les vacances');
            $alert->setActivated(true);
            $manager->persist($alert);

        $manager->flush();
    }
}
