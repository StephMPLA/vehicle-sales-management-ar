<?php

namespace App\DataFixtures;

use App\Entity\VehicleStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $available = new VehicleStatus();
       $available->setName('Available');
       $manager->persist($available);

       $sold = new VehicleStatus();
       $sold->setName('Sold');
       $manager->persist($sold);
    }
}
