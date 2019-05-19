<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Status;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $status = new Status();
        $status->setTitle('Tous');

        $manager->persist($status);
        
        $status = new Status();
        $status->setTitle('Elève');

        $manager->persist($status);

        $status = new Status();
        $status->setTitle('Professeur');

        $manager->persist($status);

        $manager->flush();
    }
}
