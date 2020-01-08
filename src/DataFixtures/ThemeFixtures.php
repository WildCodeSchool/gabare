<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ThemeFixtures extends Fixture
{
    const THEMES = [
        'Animations' => '#E8C535',
        'Evènements' => '#0D9215',
        'Portraits' => '#DF792E',
        'Livre de bord' => '#F3F589',
        'Nouveautés' => '#8F89F5',
    ];

    public function load(ObjectManager $manager)
    {
        $index = 0;
        foreach (self::THEMES as $key => $data) {
            $themes = new Theme();
            $themes->setName($key);
            $themes->setColor($data);
            $this->addReference('themes_' . $index, $themes);
            $manager->persist($themes);
            $index ++;
        }
            $manager->flush();
    }
}
