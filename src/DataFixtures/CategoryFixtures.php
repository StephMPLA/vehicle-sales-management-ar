<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{    public function load(ObjectManager $manager): void
    {
        $suv = new Category();
        $suv->setName('Suv');
        $manager->persist($suv);
        $manager->flush();
    }
}
