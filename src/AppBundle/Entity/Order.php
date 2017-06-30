<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 */
class Order
{
    const DISCOUNT_PER_ITEM = 13;
    const DISCOUNT_MAX_PERCENT = 0.25;
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $customerId;

    /**
     * @var string
     */
    private $totalAmountNet;

    /**
     * @var string
     */
    private $shippingCosts;

    /**
     * @var string
     */
    private $discountValue;

    /**
     * @var integer
     */
    private $paymentMethodId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderItems;

    /**
     * @var \AppBundle\Entity\PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var \AppBundle\Entity\Customer
     */
    private $customer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return Order
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set totalAmountNet
     *
     * @param string $totalAmountNet
     * @return Order
     */
    public function setTotalAmountNet($totalAmountNet)
    {
        $this->totalAmountNet = $totalAmountNet;

        return $this;
    }

    /**
     * Get totalAmountNet
     *
     * @return string 
     */
    public function getTotalAmountNet()
    {
        return $this->totalAmountNet;
    }

    /**
     * Set shippingCosts
     *
     * @param string $shippingCosts
     * @return Order
     */
    public function setShippingCosts($shippingCosts)
    {
        $this->shippingCosts = $shippingCosts;

        return $this;
    }

    /**
     * Get shippingCosts
     *
     * @return string 
     */
    public function getShippingCosts()
    {
        return $this->shippingCosts;
    }

    /**
     * Set discountValue
     *
     * @param string $discountValue
     * @return Order
     */
    public function setDiscountValue($discountValue)
    {
        $this->discountValue = $discountValue;

        return $this;
    }

    /**
     * Get discountValue
     *
     * @return string 
     */
    public function getDiscountValue()
    {
        return $this->discountValue;
    }

    /**
     * Set paymentMethodId
     *
     * @param integer $paymentMethodId
     * @return Order
     */
    public function setPaymentMethodId($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;

        return $this;
    }

    /**
     * Get paymentMethodId
     *
     * @return integer 
     */
    public function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    /**
     * Add orderItems
     *
     * @param \AppBundle\Entity\OrderItem $orderItems
     * @return Order
     */
    public function addOrderItem(\AppBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems[] = $orderItems;
        $orderItems->setOrder($this);

        return $this;
    }

    /**
     * Remove orderItems
     *
     * @param \AppBundle\Entity\OrderItem $orderItems
     */
    public function removeOrderItem(\AppBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems->removeElement($orderItems);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set paymentMethod
     *
     * @param \AppBundle\Entity\PaymentMethod $paymentMethod
     * @return Order
     */
    public function setPaymentMethod(\AppBundle\Entity\PaymentMethod $paymentMethod = null)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return \AppBundle\Entity\PaymentMethod 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     * @return Order
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
    /**
     * @var integer
     */
    private $apiOrderId;


    /**
     * Set apiOrderId
     *
     * @param integer $apiOrderId
     * @return Order
     */
    public function setApiOrderId($apiOrderId)
    {
        $this->apiOrderId = $apiOrderId;

        return $this;
    }

    /**
     * Get apiOrderId
     *
     * @return integer 
     */
    public function getApiOrderId()
    {
        return $this->apiOrderId;
    }

    /**
     * Calculates discount value based on related items collections
     * - An order is qualified for discount only if all of its items belong to discountable collections
     * - Discount cannot exceed 25% of the order total value
     */
    public function calculateDiscount()
    {
        $orderItems = $this->getOrderItems();
        foreach($orderItems as $orderItem)
        {
            if(!$orderItem->getCollection()->isOnDiscount())
            {
                $this->setDiscountValue(0);
                return;
            }
        }
        $total = $this->getTotalAmountNet() - $this->getShippingCosts();
        $discountValue = self::DISCOUNT_PER_ITEM * count($orderItems);
        $discountPercent = $discountValue / $total;
        if($discountPercent > self::DISCOUNT_MAX_PERCENT)
        {
            $discountValue = self::DISCOUNT_MAX_PERCENT * $total;
        }
        $this->setDiscountValue($discountValue);
    }
}
