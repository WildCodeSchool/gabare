<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'the_new_password'
        ));


        $admin = new User();
        $admin->setEmail('superAdmin@gabare.com');
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'LaGabare45'
        ));

        $manager->persist($admin);


        $adminHome = new User();
        $adminHome->setEmail('homeAdmin@gabare.com');
        $adminHome->setRoles(['ROLE_ADMIN_HOME']);
        $adminHome->setPassword($this->passwordEncoder->encodePassword(
            $adminHome,
            'HomePageGabare45'
        ));

        $manager->persist($adminHome);


        $adminWho = new User();
        $adminWho->setEmail('whoAdmin@gabare.com');
        $adminWho->setRoles(['ROLE_ADMIN_WHO']);
        $adminWho->setPassword($this->passwordEncoder->encodePassword(
            $adminWho,
            'WhoPageGabare45'
        ));

        $manager->persist($adminWho);



        $adminGabareLife = new User();
        $adminGabareLife->setEmail('GabareLifeAdmin@gabare.com');
        $adminGabareLife->setRoles(['ROLE_ADMIN_GABARE_LIFE']);
        $adminGabareLife->setPassword($this->passwordEncoder->encodePassword(
            $adminGabareLife,
            'GabarelifePageGabare45'
        ));

        $manager->persist($adminGabareLife);



        $adminJoinUs = new User();
        $adminJoinUs->setEmail('joinUsAdmin@gabare.com');
        $adminJoinUs->setRoles(['ROLE_ADMIN_JOIN_US']);
        $adminJoinUs->setPassword($this->passwordEncoder->encodePassword(
            $adminJoinUs,
            'JoinUsPageGabare45'
        ));

        $manager->persist($adminJoinUs);



        $manager->flush();
    }
}
