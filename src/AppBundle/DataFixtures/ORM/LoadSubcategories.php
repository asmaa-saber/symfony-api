<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subcategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSubcategories extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $subcategory = new Subcategory();
        $subcategory->setName("Jacket");
        $subcategory->setCategory($this->getReference('fashion-category'));
        $manager->persist($subcategory);

        $subcategory2 = new Subcategory();
        $subcategory2->setName("sport");
        $subcategory2->setCategory($this->getReference('watches-category'));
        $manager->persist($subcategory2);

        $manager->flush();

        $this->addReference('jacket-subcategory', $subcategory);
        $this->addReference('sport-subcategory', $subcategory2);
    }
    public function getOrder()
    {
        return 3;
    }
}