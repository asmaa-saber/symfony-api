<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Fashion");
        $manager->persist($category);

        $category2 = new Category();
        $category2->setName("Watches");
        $manager->persist($category2);

        $manager->flush();

        $this->addReference('fashion-category', $category);
        $this->addReference('watches-category', $category2);
    }
    public function getOrder()
    {
        return 2;
    }
}