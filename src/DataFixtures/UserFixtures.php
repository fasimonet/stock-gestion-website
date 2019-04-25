<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <=10; $i++)
        {
            $user = new User();    
            $user->setUsername("username$i")                 
                 ->setFirstname("prenom $i")
                 ->setLastname("nom $i")
                 ->setStatus("eleve")
                 ->setPassword("mdp")
                 ->setClass("terminale $i");

            $manager->persist($user);
        }

        for($i = 11; $i <= 15; $i++)
        {
            $user = new User();    
            $user->SetUsername("username$i")
                 ->setFirstname("prenom $i")
                 ->setLastname("nom $i")
                 ->setStatus("professeur")
                 ->setPassword("supermdp");

            $manager->persist($user);            
        }



        $manager->flush();
    }
}
