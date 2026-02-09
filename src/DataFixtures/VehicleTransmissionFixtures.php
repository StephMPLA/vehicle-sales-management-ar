<?php

namespace App\DataFixtures;

use App\Entity\VehicleTransmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTransmissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $auto = new VehicleTransmission();
       $auto->setName('Auto');
       $manager->persist($auto);
    }
}
