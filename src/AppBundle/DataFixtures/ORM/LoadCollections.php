<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Collection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCollections extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $collection1 = new Collection();
        $collection1->setName('Coll allows discount');
        $collection1->setOnDiscount(true);
        $manager->persist($collection1);

        $collection2 = new Collection();
        $collection2->setName('Coll without discount');
        $collection2->setOnDiscount(false);
        $manager->persist($collection2);

        $manager->flush();

        $this->addReference('discount-collection', $collection1);
        $this->addReference('no-discount-collection', $collection2);
    }
    public function getOrder()
    {
        return 1;
    }
}