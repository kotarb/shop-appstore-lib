<?php

namespace DreamCommerce\Model\Entity;

class Subscription extends ShopDependent implements SubscriptionInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var int
     */
    protected $subscriptionId;

    /**
     * @var \DateTime $expirationDate
     */
    protected $expirationDate;

    /**
     * @return int
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * @param int $subscriptionId
     * @return $this
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTime $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param ApplicationInterface $application
     * @return $this
     */
    public function setApplication(ApplicationInterface $application)
    {
        $this->application = $application;
        return $this;
    }
}