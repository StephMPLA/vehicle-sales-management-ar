<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Fuel;
use App\Entity\Vehicle;
use App\Entity\VehicleStatus;
use App\Entity\VehicleTransmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $alfa = new Vehicle();
        $alfa->setName('Alfa Roméo Tonale SPRINT');
        $alfa->setBrand($this->getReference(BrandFixtures::BRAND_ALFA_REFERENCE, Brand::class));
        $alfa->setCategory($this->getReference(CategoryFixtures::SUV_CATEGORY_REFERENCE, Category::class));
        $alfa->setFuel($this->getReference(FuelFixtures::GAZOLINE_FUEL_REFERENCE, Fuel::class));
        $alfa->setStatus($this->getReference(VehicleStatusFixtures::AVAILABLE_STATUS_REFERENCE, VehicleStatus::class));
        $alfa->setTransmission($this->getReference(VehicleTransmissionFixtures::AUTOMATIC_TRANSMISSION_REFERENCE, VehicleTransmission::class));
        $alfa->setDescription("La nouvelle Alfa Romeo Tonale Ibrida Plug-In Q4 incarne l'expression la plus pure du style et de l'innovation italiens. Avec un design plus audacieux, un intérieur raffiné et des services numériques de pointe, elle procure des sensations de conduite exceptionnelles, tout en offrant une association unique entre sportivité, confort et technologie.");
        $alfa->setHorsePower(175);
        $alfa->setIsNew(true);
        $alfa->setMileage(0);
        $alfa->setPrice(53700);
        $alfa->setYear(2024);
        $alfa->setWeight(1584);
        $manager->persist($alfa);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            BrandFixtures::class, CategoryFixtures::class, FuelFixtures::class, VehicleStatusFixtures::class, VehicleTransmissionFixtures::class
        ];
    }
}
