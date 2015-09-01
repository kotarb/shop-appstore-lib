<?php

namespace DreamCommerce\Model;

class Shop implements ShopInterface
{
    /**
     * @var int $shopId
     */
    protected $shopId;

    /**
     * @var string $shopUniqId
     */
    protected $shopUniqId;

    /**
     * @var \DateTime $creationDate
     */
    protected $creationDate;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var string version
     */
    protected $version;

    /**
     * @var TokenInterface $token
     */
    protected $token;

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
     * @param int $shopId
     * @return $this
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopUniqId()
    {
        return $this->shopUniqId;
    }

    /**
     * @param string $shopUniqId
     * @return $this
     */
    public function setShopUniqId($shopUniqId)
    {
        $this->shopUniqId = $shopUniqId;
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

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @param  string  $version  A version string (e.g. "0.7.1").
     * @return int           -1 if the $version is older,
     *                           0 if they are the same,
     *                           and +1 if $version is newer.
     */
    public function compareVersion($version)
    {
        $version = strtolower($version);
        $version = preg_replace('/(\d)pr(\d?)/', '$1a$2', $version);
        return version_compare($version, strtolower($this->version));
    }

    /**
     * @return TokenInterface
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
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