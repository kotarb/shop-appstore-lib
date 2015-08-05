<?php

namespace DreamCommerce\Model;

class Billing implements BillingInterface
{
    /**
     * @var integer $id
     */
    protected $billingId;

    /**
     * @var \DateTime $creationDate
     */
    protected $creationDate;

    /**
     * @var \DreamCommerce\Model\ShopInterface $shop
     */
    protected $shop;

    /**
     * @return int
     */
    public function getBillingId()
    {
        return $this->billingId;
    }

    /**
     * @param int $billingId
     * @return $this
     */
    public function setBillingId($billingId)
    {
        $this->billingId = $billingId;
        return $this;
    }

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }
}