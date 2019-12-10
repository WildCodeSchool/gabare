<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 2; $i++) {
            $actualities = new Article();
            $actualities->setImage($faker->imageUrl())
                ->setTitle($faker->sentence())
                ->setDescription($faker->text(400))
                ->setDate($faker->DateTime());
            $actualities->setTheme($this->getReference('themes_'.random_int(0, count(ThemeFixtures::THEMES)-1)));
            $manager->persist($actualities);
            //$this->addReference('actualities' . $i, $actualities);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ThemeFixtures::class];
    }
}
