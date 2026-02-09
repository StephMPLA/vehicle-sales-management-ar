<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $alfa = new Vehicle();
        $alfa->setName('Alfa Roméo 8C 2900');
        $alfa->setBrand($this->getReference(BrandFixtures::BRAND_ALFA_REFERENCE, Brand::class));

        //Todo à termier !!
    }
}
