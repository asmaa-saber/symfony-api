<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Order;
use AppBundle\Entity\OrderItem;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class OrderTest extends WebTestCase
{
    public function setUp()
    {
        $this->fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadCategories',
            'AppBundle\DataFixtures\ORM\LoadCollections',
            'AppBundle\DataFixtures\ORM\LoadCustomers',
            'AppBundle\DataFixtures\ORM\LoadPaymentMethods',
            'AppBundle\DataFixtures\ORM\LoadSubcategories',
        ])->getReferenceRepository();
    }

    public function testOrderDiscountBelowThreshold()
    {
        $order = new Order();
        $order->setShippingCosts(10);
        $order->setTotalAmountNet(110);

        $discountItem = new OrderItem();
        $discountItem->setCollection($this->fixtures->getReference('discount-collection'));
        $order->addOrderItem($discountItem);

        $order->calculateDiscount();
        $this->assertEquals($order->getDiscountValue(),13.00);
    }

    public function testOrderDiscountExceedsThreshold()
    {
        $order = new Order();
        $order->setShippingCosts(1);
        $order->setTotalAmountNet(21);

        $discountItem = new OrderItem();
        $discountItem->setCollection($this->fixtures->getReference('discount-collection'));
        $order->addOrderItem($discountItem);

        $order->calculateDiscount();
        $this->assertEquals($order->getDiscountValue(),5.00);
    }

    public function testOrderDiscountEqualsThreshold()
    {
        $order = new Order();
        $order->setShippingCosts(20);
        $order->setTotalAmountNet(72);

        $discountItem = new OrderItem();
        $discountItem->setCollection($this->fixtures->getReference('discount-collection'));
        $order->addOrderItem($discountItem);

        $order->calculateDiscount();
        $this->assertEquals($order->getDiscountValue(),13.00);
    }

    public function testOrderDiscountZero()
    {
        $order = new Order();
        $order->setShippingCosts(20);
        $order->setTotalAmountNet(72);

        $noDiscountItem = new OrderItem();
        $noDiscountItem->setCollection($this->fixtures->getReference('no-discount-collection'));
        $order->addOrderItem($noDiscountItem);

        $order->calculateDiscount();
        $this->assertEquals($order->getDiscountValue(),0);

        $discountItem = new OrderItem();
        $discountItem->setCollection($this->fixtures->getReference('discount-collection'));
        $order->addOrderItem($discountItem);

        $order->calculateDiscount();
        $this->assertEquals($order->getDiscountValue(),0);
    }
}