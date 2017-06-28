<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 */
class Order
{
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
     * @var \AppBundle\Entity\PaymentMethod
     */
    private $customer;


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
     * Set customer
     *
     * @param \AppBundle\Entity\PaymentMethod $customer
     * @return Order
     */
    public function setCustomer(\AppBundle\Entity\PaymentMethod $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\PaymentMethod 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
