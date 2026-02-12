<?php

namespace App\DataFixtures;

use App\Fuel\Entity\Fuel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FuelFixtures extends Fixture
{
    public const GAZOLINE_FUEL_REFERENCE = 'gazoline_fuel';
    public function load(ObjectManager $manager): void
    {
       $gazoline = new Fuel();
       $gazoline->setName('Gazoline');
       $this->addReference(self::GAZOLINE_FUEL_REFERENCE, $gazoline);
       $manager->persist($gazoline);
       $manager->flush();
    }
}
