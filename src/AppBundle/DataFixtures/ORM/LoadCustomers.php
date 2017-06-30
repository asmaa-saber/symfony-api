<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCustomers extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $smith = new Customer();
        $smith->setEmail("smith@mail.com");
        $manager->persist($smith);

        $manager->flush();

        $this->addReference('smith', $smith);
    }
    public function getOrder()
    {
        return 5;
    }
}