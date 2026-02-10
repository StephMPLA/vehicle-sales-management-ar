<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const SUV_CATEGORY_REFERENCE = 'suv_category';
    public function load(ObjectManager $manager): void
    {
        $suv = new Category();
        $suv->setName('Suv');
        $this->addReference(self::SUV_CATEGORY_REFERENCE, $suv);
        $manager->persist($suv);
        $manager->flush();
    }
}
