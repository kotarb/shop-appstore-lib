<?php

namespace DreamCommerce\Model;

interface TokenInterface
{
    /**
     * @return mixed
     */
    public function getShop();

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);
}