<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <=10; $i++)
        {
            $product = new User();    
            $product->setName("name$i")                 
                    ->setDescription("description $i")
                    ->setLastname("nom $i")
                    ->setStatus("eleve")
                    ->setPassword("mdp")
                    ->setClass("terminale $i");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
