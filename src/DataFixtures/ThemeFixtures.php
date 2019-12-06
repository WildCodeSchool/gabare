<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ThemeFixtures extends Fixture
{
    const THEMES = [
        'Cuisine',
        'Découverte',
        'Nouveautés',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::THEMES as $key => $data) {
            $themes = new Theme();
            $themes->setName($data);
            $this->addReference('themes_' . $key, $themes);
            $manager->persist($themes);
        }
            $manager->flush();
    }
}
