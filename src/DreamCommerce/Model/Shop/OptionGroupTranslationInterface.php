<?php

namespace DreamCommerce\Model\Shop;

interface OptionGroupTranslationInterface extends TranslationInterface, BaseInterface
{
    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup($optionGroup);
}