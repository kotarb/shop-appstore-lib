<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

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