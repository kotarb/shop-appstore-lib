<?php

namespace DreamCommerce\Model\Shop;

interface OptionInterface extends TranslationDependentInterface, ResourceDependentInterface
{
    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup(OptionGroupInterface $optionGroup);
}