<?php

namespace DreamCommerce\Model\Entity;

use DreamCommerce\Model\Provider\ProviderInterface;

interface ShopDependentInterface
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

    /**
     * @return ProviderInterface
     */
    public function getProvider();

    /**
     * @param ProviderInterface $provider
     * @return $this
     */
    public function setProvider(ProviderInterface $provider);
}