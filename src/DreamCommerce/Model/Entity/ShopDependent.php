<?php

namespace DreamCommerce\Model\Entity;

use DreamCommerce\Model\Provider\ProviderInterface;

abstract class ShopDependent implements ShopDependentInterface
{
    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var ProviderInterface
     */
    protected $provider;

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

    /**
     * @return ProviderInterface
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param ProviderInterface $provider
     * @return $this
     */
    public function setProvider(ProviderInterface $provider)
    {
        $this->provider = $provider;
        return $this;
    }
}