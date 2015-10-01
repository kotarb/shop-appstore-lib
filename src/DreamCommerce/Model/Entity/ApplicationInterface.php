<?php

namespace DreamCommerce\Model\Entity;

interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getClientId();

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId);

    /**
     * @return string
     */
    public function getClientSecret();

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret);

    /**
     * @return string
     */
    public function getAppStoreSecret();

    /**
     * @param string $appStoreSecret
     * @return $this
     */
    public function setAppStoreSecret($appStoreSecret);

    public function getBillings();

    public function addBilling(BillingInterface $billing);

    public function setBillings($billings);

    public function getShops();

    public function addShop(ShopInterface $shop);

    public function setShops($shops);

    public function getSubscriptions();

    public function addSubscription(SubscriptionInterface $subscription);

    public function setSubscriptions($subscriptions);

    public function getTokens();

    public function addToken(TokenInterface $token);

    public function setTokens($tokens);
}