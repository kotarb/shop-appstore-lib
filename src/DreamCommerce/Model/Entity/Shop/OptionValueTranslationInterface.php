<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

interface OptionValueTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return OptionValueInterface
     */
    public function getOptionValue();

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function setOptionValue(OptionValueInterface $optionValue);
}