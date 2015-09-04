<?php

namespace DreamCommerce\Model\Entity;

interface ShopInterface
{
    /**
     * @return string
     */
    public function getShopUniqId();

    /**
     * @param string $shopUniqId
     * @return $this
     */
    public function setShopUniqId($shopUniqId);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * @return TokenInterface
     */
    public function getToken();

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function setToken(TokenInterface $token);

    /**
     * @return \ArrayAccess
     */
    public function getBillings();
    /**
     * @param BillingInterface $billing
     * @return $this
     */
    public function addBilling(BillingInterface $billing);

    /**
     * @param \ArrayAccess $billings
     * @return $this
     */
    public function setBillings($billings);

    /**
     * @return \ArrayAccess
     */
    public function getSubscriptions();

    /**
     * @param SubscriptionInterface $subscription
     * @return $this
     */
    public function addSubscription(SubscriptionInterface $subscription);

    /**
     * @param \ArrayAccess $subscriptions
     * @return $this
     */
    public function setSubscriptions($subscriptions);
}