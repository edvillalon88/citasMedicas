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
        $user->setUsername('admin');
        $user->setNombre('Eduardo');
        $user->setApellidos('Valdes Villalon');
        $user->setRoles(['ROLE_ADMINISTRADOR']);
        // ...
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,             
            'Villalon8801*'
        ));
        $manager->persist($user);
        $manager->flush();
    }
}
