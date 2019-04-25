<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 20; $i++)
        {
            $product = new Product();

            $product->setName("product $i")
                    ->setDescription("the product $i is an amazing product ! You are not ready !")
                    ->setBarcode(12345678 + $i)
                    ->setImage("http://placehold.it/350x150")
                    ->setLocalisation("casier $i")
                    ->setStock($i + 10)
                    ->setCategory("ink");

            $manager->persist($product);
        }

        for($i = 21; $i <= 40; $i++)
        {
            $product = new Product();

            $product->setName("product $i")
                    ->setDescription("the product $i is an amazing product ! You are not ready !")
                    ->setBarcode(12345678 + $i)
                    ->setImage("http://placehold.it/350x150")
                    ->setLocalisation("casier $i")
                    ->setStock($i + 10)
                    ->setCategory("chemical");

            $manager->persist($product);
        }

        for($i = 411; $i <= 60; $i++)
        {
            $product = new Product();

            $product->setName("product $i")
                    ->setDescription("the product $i is an amazing product ! You are not ready !")
                    ->setBarcode(12345678 + $i)
                    ->setImage("http://placehold.it/350x150")
                    ->setLocalisation("casier $i")
                    ->setStock($i + 10)
                    ->setCategory("printable support");

            $manager->persist($product);
        }

        for($i = 61; $i <= 80; $i++)
        {
            $product = new Product();

            $product->setName("product $i")
                    ->setDescription("the product $i is an amazing product ! You are not ready !")
                    ->setBarcode(12345678 + $i)
                    ->setImage("http://placehold.it/350x150")
                    ->setLocalisation("casier $i")
                    ->setStock($i + 10)
                    ->setCategory("other");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
