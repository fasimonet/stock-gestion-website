<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <=10; $i++)
        {
            $category= new Category();
            $category= $manager->getRepository(Category::class)->findOneById(6);
            dump($category);

            $product = new Product();    
            $product->setName("name$i")                 
                    ->setDescription("description $i")
                    ->setBarCode("123456$i")
                    ->setLocalisation("Casier 1")
                    ->setStock(100)
                    ->setCategory($category);

            $manager->persist($product);
        }
        /*
        //Product 1
        $product = new Product();  
        $category2= new Category();
        $category2= $manager->getRepository(Category::class)->find(6);

        $product->setName("Offset 80g/m² 52x72")                 
                ->setDescription("")
                ->setBarCode("I100J")
                ->setImage("http://placehold.it/350x150")
                ->setLocalisation("")
                ->setStock(0)
                ->setCategory($category2);
        
        $manager->persist($product);

        //Product 2
        $category3= new Category();
        $category3= $manager->getRepository(Category::class)->find(6);

        $product->setName("Offset 90g/m² 52x72")                 
                ->setDescription("")
                ->setBarCode("I100K")
                ->setImage("http://placehold.it/350x150")
                ->setLocalisation("")
                ->setStock(0)
                ->setCategory($category3);*/

        //Product 3

        $manager->persist($product);

        $manager->flush();
        
    }
}
