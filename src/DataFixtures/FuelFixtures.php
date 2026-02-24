<?php

namespace App\DataFixtures;

use App\Entity\Fuel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FuelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fuels = ['Diesel', 'Gasoline', 'Electric', 'Hybrid', 'Hydrogen', 'Plug-in Hybrid'];
        foreach ($fuels as $fuelName) {
            $fuel = new Fuel();
            $fuel->setName($fuelName);
            $manager->persist($fuel);
        }
       $manager->flush();
    }
}
