<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
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
        for($i = 1; $i <=10; $i++)
        {
            $user = new User();    
            $user->setUsername("username$i")                 
                 ->setFirstname("prenom $i")
                 ->setLastname("nom $i")
                 ->setPassword($this->passwordEncoder->encodePassword(
                        $user,
                        'testtest'
                 ))
                 ->setClass("terminale $i");

            $user->setRoles('ROLE_USER');

            $manager->persist($user);
        }

        for($i = 11; $i <= 15; $i++)
        {
            $user = new User();    
            $user->SetUsername("username$i")
                 ->setFirstname("prenom $i")
                 ->setLastname("nom $i")
                 ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    'testtest'
                 ));

            $user->setRoles('ROLE_ADMIN');

            $manager->persist($user);            
        }

        $manager->flush();
    }
}
