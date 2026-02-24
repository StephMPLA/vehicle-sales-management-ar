<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = [ 'BMW', 'Honda', 'Toyota', 'Renault', 'Mercedes-Benz','Peugeot', 'Tesla', 'Volkswagen', 'Citroen' , 'Ford', 'Alfa', 'Audi', 'Nissan', 'Opel', 'Hyundai'];
        foreach ($brands as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);
        }
        $manager->flush();
    }
}
