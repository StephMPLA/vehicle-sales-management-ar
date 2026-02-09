<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRAND_ALFA_REFERENCE = 'brand_alfa';

    public function load(ObjectManager $manager): void
    {
        //Brand
        $bmw = new Brand();
        $bmw->setName('BMW');
        $manager->persist($bmw);

        $peugeot = new Brand();
        $peugeot->setName('Peugeot');
        $manager->persist($peugeot);

        $renault = new Brand();
        $renault->setName('Renault');
        $manager->persist($renault);

        $tesla = new Brand();
        $tesla->setName('Tesla');
        $manager->persist($tesla);

        $citroen = new Brand();
        $citroen->setName('Citroen');
        $manager->persist($citroen);

        $ford = new Brand();
        $ford->setName('Ford');
        $manager->persist($ford);

        $alfa = new Brand();
        $alfa->setName('Alfa');
        $manager->persist($alfa);
        $this->addReference(self::BRAND_ALFA_REFERENCE, $alfa);

        $audi = new Brand();
        $audi->setName('Audi');
        $manager->persist($audi);

        $volkswagen = new Brand();
        $volkswagen->setName('Volkswagen');
        $manager->persist($volkswagen);

        $toyota = new Brand();
        $toyota->setName('Toyota');
        $manager->persist($toyota);

        $nissan = new Brand();
        $nissan->setName('Nissan');
        $manager->persist($nissan);

        $opel = new Brand();
        $opel->setName('Opel');
        $manager->persist($opel);

        $hyundai = new Brand();
        $hyundai->setName('Hyundai');
        $manager->persist($hyundai);

        $manager->flush();
    }
}
