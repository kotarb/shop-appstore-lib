<?php

namespace DreamCommerce\Model;

interface SubscriptionInterface
{
    /**
     * @return ShopInterface
     */
    public function getShop();

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);
}