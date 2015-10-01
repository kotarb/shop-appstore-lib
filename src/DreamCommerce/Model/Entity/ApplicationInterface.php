<?php

namespace DreamCommerce\Model\Entity;

use DreamCommerce\ClientInterface;

interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getApplicationId();

    /**
     * @param string $applicationId
     * @return $this
     */
    public function setApplicationId($applicationId);

    /**
     * @return ClientInterface
     */
    public function getClientHandler();

    /**
     * @param ClientInterface $clientHandler
     * @return $this
     */
    public function setClientHandler($clientHandler);

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
    public function getShops();

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function addShop(ShopInterface $shop);

    /**
     * @param \ArrayAccess $shops
     * @return $this
     */
    public function setShops($shops);

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

    /**
     * @return \ArrayAccess
     */
    public function getTokens();

    /**
     * @param TokenInterface $token
     * @return $this
     */
    public function addToken(TokenInterface $token);

    /**
     * @param \ArrayAccess $tokens
     * @return $this
     */
    public function setTokens($tokens);
}