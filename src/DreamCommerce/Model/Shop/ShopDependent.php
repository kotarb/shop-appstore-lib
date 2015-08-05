<?php

namespace DreamCommerce\Model\Shop;

use DreamCommerce\Model\ShopInterface;

abstract class ShopDependent implements ShopDependentInterface
{
    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $shop;
    }
}