<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class WorkerFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 3; $i++) {
            $worker = new Worker();
            $worker->setFirstName($faker->firstName);
            $worker->setLastName($faker->lastName);
            $worker->setFunction($faker->sentence(3, true));
            $worker->setPortrait($faker->imageUrl(200, 200, 'people'));
            $worker->setActivity($this->getReference('activities_0'));
            $manager->persist($worker);
        }

        for ($i = 0; $i <= 17; $i++) {
            $worker = new Worker();
            $worker->setFirstName($faker->firstName);
            $worker->setLastName($faker->lastName);
            $worker->setFunction($faker->sentence(2, true));
            $worker->setPortrait($faker->imageUrl(200, 200, 'people'));
            $worker->setEmail($faker->safeEmail);
            $worker->setActivity($this->getReference('activities_1'));
            $manager->persist($worker);
        }

        for ($i = 0; $i <= 10; $i++) {
            $worker = new Worker();
            $worker->setFirstName($faker->firstName);
            $worker->setLastName($faker->lastName);
            $worker->setFunction($faker->sentence(2, true));
            $worker->setPortrait($faker->imageUrl(200, 200, 'people'));
            $worker->setEmail($faker->safeEmail);
            $worker->setActivity($this->getReference('activities_2'));
            $manager->persist($worker);
        }

        for ($i = 0; $i <= 49; $i++) {
            $pioneer = new Worker();
            $pioneer->setFirstName($faker->firstName);
            $pioneer->setLastName($faker->lastName);
            $pioneer->setActivity($this->getReference('activities_3'));
            $manager->persist($pioneer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ActivityFixtures::class];
    }
}
