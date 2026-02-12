<?php

namespace App\DataFixtures;

use App\VehicleStatus\Entity\VehicleStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleStatusFixtures extends Fixture
{
    public const AVAILABLE_STATUS_REFERENCE = 'available_status';
    public function load(ObjectManager $manager): void
    {
       $available = new VehicleStatus();
       $available->setName('Available');
       $this->addReference(self::AVAILABLE_STATUS_REFERENCE, $available);
       $manager->persist($available);

       $sold = new VehicleStatus();
       $sold->setName('Sold');
       $manager->persist($sold);
       $manager->flush();
    }
}
