<?php

namespace App\DataFixtures;

use App\Entity\VehicleStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status = ['Available', 'Reserved', 'Sold', 'Unavailable'];
        foreach ($status as $statusName) {
            $vehicleStatus = new VehicleStatus();
            $vehicleStatus->setName($statusName);
            $manager->persist($vehicleStatus);
        }
       $manager->flush();
    }
}
