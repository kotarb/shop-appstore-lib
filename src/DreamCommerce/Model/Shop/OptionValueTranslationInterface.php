<?php

namespace DreamCommerce\Model\Shop;

interface OptionValueTranslationInterface extends TranslationInterface, BaseInterface
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