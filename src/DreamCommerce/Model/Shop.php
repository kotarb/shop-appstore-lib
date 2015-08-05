<?php

namespace DreamCommerce\Model;

class Shop implements ShopInterface
{
    /**
     * @var int $shopId
     */
    protected $shopId;

    /**
     * @var \DateTime $creationDate
     */
    protected $creationDate;

    /**
     * @var string $shopToken
     */
    protected $shopToken;

    /**
     * @var string $shopUrl
     */
    protected $shopUrl;

    /**
     * @var TokenInterface $accessToken
     */
    protected $accessToken;

    /**
     * @var \ArrayAccess $billings
     */
    protected $billings;

    /**
     * @var \ArrayAccess $subscriptions
     */
    protected $subscriptions;

    public function __construct()
    {
        $this->billings = new \ArrayObject();
        $this->subscriptions = new \ArrayObject();
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @return \Datetime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \Datetime $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopToken()
    {
        return $this->shopToken;
    }

    /**
     * @param string $shopToken
     * @return $this
     */
    public function setShopToken($shopToken)
    {
        $this->shopToken = $shopToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }

    /**
     * @param string $shopUrl
     * @return $this
     */
    public function setShopUrl($shopUrl)
    {
        $this->shopUrl = $shopUrl;
        return $this;
    }

    /**
     * @return TokenInterface
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param TokenInterface $accessToken
     * @return $this
     */
    public function setAccessToken(TokenInterface $accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getBillings()
    {
        return $this->billings;
    }

    /**
     * @param BillingInterface $billing
     * @return $this
     */
    public function addBilling(BillingInterface $billing)
    {
        $this->billings[] = $billing;
        return $this;
    }

    /**
     * @param \ArrayAccess $billings
     * @return $this
     */
    public function setBillings($billings)
    {
        $this->billings = $billings;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @param SubscriptionInterface $subscription
     * @return $this
     */
    public function addSubscription(SubscriptionInterface $subscription)
    {
        $this->subscriptions[] = $subscription;
        return $this;
    }

    /**
     * @param \ArrayAccess $subscriptions
     * @return $this
     */
    public function setSubscriptions($subscriptions)
    {
        $this->subscriptions = $subscriptions;
        return $this;
    }
}