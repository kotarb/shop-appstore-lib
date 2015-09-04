<?php

namespace DreamCommerce\Model\Entity;

class Billing extends ShopDependent implements BillingInterface
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