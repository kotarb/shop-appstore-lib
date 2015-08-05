<?php

namespace DreamCommerce\Model\Shop;

interface ShippingTranslationInterface extends TranslationInterface, BaseInterface
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