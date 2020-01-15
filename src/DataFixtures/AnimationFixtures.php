<?php

namespace App\DataFixtures;

use App\Entity\Animation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AnimationFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 6; $i++) {
            $animation = new Animation();
            $animation->setTitle($faker->text(15));
            $animation->setDescription($faker->text(30));
            $animation->setSchedule($faker->dateTime);
            $animation->setHourStart($faker->dateTime);
            $animation->setHourEnd($faker->dateTime);
            $animation->setUpdatedAt($faker->DateTime());
            $animation->setImageName('');
            $manager->persist($animation);
        }
        $manager->flush();
    }
}
