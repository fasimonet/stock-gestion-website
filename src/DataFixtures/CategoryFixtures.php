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
        $category->setTitle('Toutes')
                 ->setDescription('');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Support imprimable')
                 ->setDescription('Tous les types de support d\'impression : papiers, bois, toile ect');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Encre')
                 ->setDescription('Tous les types d\'encre quels que soient leur couleur ou leur type');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Produit chimique')
                 ->setDescription('Produits d\'entretien');

        $manager->persist($category);

        $category = new Category();
        $category->setTitle('Autre')
                 ->setDescription('Matériel de protection');

        $manager->persist($category);

        $manager->flush();
    }
}
