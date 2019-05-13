<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setTitle('Support imprimable')
                 ->setDescription('');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Encre')
                 ->setDescription('');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Produit chimique')
                 ->setDescription('Produits d\'entretien');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Autre')
                 ->setDescription('Gants');

        $manager->persist($category);

        $manager->flush();
    }
}
