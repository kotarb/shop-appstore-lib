<?php

namespace DreamCommerce\Model;

interface ShopInterface
{
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