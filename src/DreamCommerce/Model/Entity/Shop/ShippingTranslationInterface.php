<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

interface ShippingTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return ShippingInterface
     */
    public function getShipping();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping(ShippingInterface $shipping);
}