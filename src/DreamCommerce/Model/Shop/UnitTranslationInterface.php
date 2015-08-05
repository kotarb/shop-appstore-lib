<?php

namespace DreamCommerce\Model\Shop;

interface UnitTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return UnitInterface
     */
    public function getUnit();

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit($unit);
}