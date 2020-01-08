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

        // Création d’un utilisateur de type “SuperAdministrateur”
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_SUPER_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        // Création d’un utilisateur de type “administrateurHome”
        $adminHome = new User();
        $adminHome->setEmail('admin@home.com');
        $adminHome->setRoles(['ROLE_ADMIN_HOME']);
        $adminHome->setPassword($this->passwordEncoder->encodePassword(
            $adminHome,
            'homepassword'
        ));

        $manager->persist($adminHome);

        // Création d’un utilisateur de type “administrateurWho”
        $adminWho = new User();
        $adminWho->setEmail('admin@who.com');
        $adminWho->setRoles(['ROLE_ADMIN_WHO']);
        $adminWho->setPassword($this->passwordEncoder->encodePassword(
            $adminWho,
            'whopassword'
        ));

        $manager->persist($adminWho);


        // Création d’un utilisateur de type “administrateurGabareLife”
        $adminGabareLife = new User();
        $adminGabareLife->setEmail('admin@gabarelife.com');
        $adminGabareLife->setRoles(['ROLE_ADMIN_GABARE_LIFE']);
        $adminGabareLife->setPassword($this->passwordEncoder->encodePassword(
            $adminGabareLife,
            'gabarelifepassword'
        ));

        $manager->persist($adminGabareLife);


        // Création d’un utilisateur de type “administrateurJoinUs”
        $adminJoinUs = new User();
        $adminJoinUs->setEmail('admin@joinus.com');
        $adminJoinUs->setRoles(['ROLE_ADMIN_JOIN_US']);
        $adminJoinUs->setPassword($this->passwordEncoder->encodePassword(
            $adminJoinUs,
            'joinuspassword'
        ));

        $manager->persist($adminJoinUs);


        // Sauvegarde des  nouveaux utilisateurs :
        $manager->flush();
    }
}
