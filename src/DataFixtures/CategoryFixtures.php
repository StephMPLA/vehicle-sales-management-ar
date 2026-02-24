<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = ['Convertible', 'Coupe', 'Hatchback', 'Minivan', 'Off-road', 'Pickup', 'Sedan', 'Sports Car', 'Station Wagon', 'SUV', 'Utility Vehicle', 'Van' ];
        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
