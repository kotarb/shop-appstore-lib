<?php

namespace DreamCommerce\Model\Entity;

class Application implements ApplicationInterface
{
    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $appStoreSecret;

    /**
     * @var \ArrayAccess
     */
    protected $billings;

    /**
     * @var \ArrayAccess
     */
    protected $shops;

    /**
     * @var \ArrayAccess
     */
    protected $subscriptions;

    /**
     * @var \ArrayAccess
     */
    protected $tokens;

    public function __construct()
    {
        $this->billings = new \ArrayObject();
        $this->shops = new \ArrayObject();
        $this->subscriptions = new \ArrayObject();
        $this->tokens = new \ArrayObject();
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppStoreSecret()
    {
        return $this->appStoreSecret;
    }

    /**
     * @param string $appStoreSecret
     * @return $this
     */
    public function setAppStoreSecret($appStoreSecret)
    {
        $this->appStoreSecret = $appStoreSecret;
        return $this;
    }

    /**
     * @return mixed
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
     * @param mixed $billings
     * @return $this
     */
    public function setBillings($billings)
    {
        $this->billings = $billings;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShops()
    {
        return $this->shops;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function addShop(ShopInterface $shop)
    {
        $this->shops[] = $shop;
        return $this;
    }

    /**
     * @param mixed $shops
     * @return $this
     */
    public function setShops($shops)
    {
        $this->shops = $shops;
        return $this;
    }

    /**
     * @return mixed
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
     * @param mixed $subscriptions
     * @return $this
     */
    public function setSubscriptions($subscriptions)
    {
        $this->subscriptions = $subscriptions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function addToken(TokenInterface $token)
    {
        $this->tokens[] = $token;
        return $this;
    }

    /**
     * @param mixed $tokens
     * @return $this;
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
        return $this;
    }
}