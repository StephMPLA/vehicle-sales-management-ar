<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Fuel;
use App\Entity\Vehicle;
use App\Entity\VehicleStatus;
use App\Entity\VehicleTransmission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation marque
        $audi = new Brand();
        $audi->setName('Audi');
        $manager->persist($audi);

        $bmw = new Brand();
        $bmw->setName('BMW');
        $manager->persist($bmw);

        $alfa = new Brand();
        $alfa->setName('Alfa Roméo');
        $manager->persist($alfa);

        $volkswagen = new Brand();
        $volkswagen->setName('Volkswagen');
        $manager->persist($volkswagen);

        //creation category
        $suv = new Category();
        $suv->setName('Suv');
        $manager->persist($suv);

        $sedan = new Category();
        $sedan->setName('sedan');
        $manager->persist($sedan);

        $utility= new Category();
        $utility->setName('utility');
        $manager->persist($utility);

        $sport = new Category();
        $sport->setName('sport');
        $manager->persist($sport);

        //creation fuel
        $gasoline = new Fuel();
        $gasoline->setName('Gasoline');
        $manager->persist($gasoline);

        $diesel = new Fuel();
        $diesel->setName('Diesel');
        $manager->persist($diesel);

        $electric = new Fuel();
        $electric->setName('Electric');
        $manager->persist($electric);

        //creation vehicletransmission
        $manual = new VehicleTransmission();
        $manual->setName('Manual');
        $manager->persist($manual);

        $automatic = new VehicleTransmission();
        $automatic->setName('Automatic');
        $manager->persist($automatic);

        //creation vehiclestatus
        $available = new VehicleStatus();
        $available->setName('Available');
        $manager->persist($available);

        $reserved = new VehicleStatus();
        $reserved->setName('Reserved');
        $manager->persist($reserved);

        $sold = new VehicleStatus();
        $sold->setName('Sold');
        $manager->persist($sold);

        //creation vehicle
        $milemiglia = new Vehicle();
        $milemiglia->setName('Alfa Romeo 8C 2900B - Mille Miglia Touring Spider');
        $milemiglia->setYear(1938);
        $milemiglia->setPrice(18000000);
        $milemiglia->setHorsepower(180);
        $milemiglia->setWeight(1000);
        $milemiglia->setDescription('L’Alfa Romeo 8C 2900B Mille Miglia Touring Spider est l’un des modèles les plus emblématiques de l’histoire automobile...');
        $milemiglia->setIsUsed(true);
        $milemiglia->setStatus($available);
        $milemiglia->setDateCreated(new \DateTimeImmutable());

        $milemiglia->setBrand($alfa);
        $milemiglia->setCategory($sport);
        $milemiglia->setFuel($gasoline);
        $milemiglia->setTransmission($manual);

        $manager->persist($milemiglia);

        $manager->flush();
    }
}
