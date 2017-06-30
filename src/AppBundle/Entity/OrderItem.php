<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 */
class OrderItem
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $orderId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var string
     */
    private $value;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @var integer
     */
    private $subcategoryId;

    /**
     * @var integer
     */
    private $collectionId;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;

    /**
     * @var \AppBundle\Entity\Collection
     */
    private $collection;

    /**
     * @var \AppBundle\Entity\Subcategory
     */
    private $subcategory;

    /**
     * @var \AppBundle\Entity\Order
     */
    private $order;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set orderId
     *
     * @param integer $orderId
     * @return OrderItem
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return OrderItem
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return OrderItem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return OrderItem
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set subcategoryId
     *
     * @param integer $subcategoryId
     * @return OrderItem
     */
    public function setSubcategoryId($subcategoryId)
    {
        $this->subcategoryId = $subcategoryId;

        return $this;
    }

    /**
     * Get subcategoryId
     *
     * @return integer 
     */
    public function getSubcategoryId()
    {
        return $this->subcategoryId;
    }

    /**
     * Set collectionId
     *
     * @param integer $collectionId
     * @return OrderItem
     */
    public function setCollectionId($collectionId)
    {
        $this->collectionId = $collectionId;

        return $this;
    }

    /**
     * Get collectionId
     *
     * @return integer 
     */
    public function getCollectionId()
    {
        return $this->collectionId;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return OrderItem
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set collection
     *
     * @param \AppBundle\Entity\Collection $collection
     * @return OrderItem
     */
    public function setCollection(\AppBundle\Entity\Collection $collection = null)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Get collection
     *
     * @return \AppBundle\Entity\Collection 
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     * @return OrderItem
     */
    public function setSubcategory(\AppBundle\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \AppBundle\Entity\Subcategory 
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set order
     *
     * @param \AppBundle\Entity\Order $order
     * @return OrderItem
     */
    public function setOrder(\AppBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \AppBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return OrderItem
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
