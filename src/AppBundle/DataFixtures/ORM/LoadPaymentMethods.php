<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PaymentMethod;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPaymentMethods extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $visa = new PaymentMethod();
        $visa->setName("VISA");
        $manager->persist($visa);

        $manager->flush();

        $this->addReference('visa', $visa);
    }
    public function getOrder()
    {
        return 4;
    }
}