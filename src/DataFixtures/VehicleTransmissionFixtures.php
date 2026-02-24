<?php

namespace App\DataFixtures;

use App\Entity\VehicleTransmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTransmissionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
     $transmissions = ['Automatic', 'CVT', 'Manual', 'Semi-automatic'];
     foreach ($transmissions as $transmissionName) {
         $vehicleTransmission = new VehicleTransmission();
         $vehicleTransmission->setName($transmissionName);
         $manager->persist($vehicleTransmission);
     }
       $manager->flush();
    }
}
