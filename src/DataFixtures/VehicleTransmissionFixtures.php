<?php

namespace App\DataFixtures;

use App\Entity\VehicleTransmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTransmissionFixtures extends Fixture
{
    public const AUTOMATIC_TRANSMISSION_REFERENCE = 'automatic_transmission';
    public function load(ObjectManager $manager): void
    {
       $auto = new VehicleTransmission();
       $auto->setName('Automatic');
       $this->addReference(self::AUTOMATIC_TRANSMISSION_REFERENCE, $auto);
       $manager->persist($auto);
       $manager->flush();
    }
}
