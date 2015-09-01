<?php

namespace DreamCommerce\Model;

interface BillingInterface
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