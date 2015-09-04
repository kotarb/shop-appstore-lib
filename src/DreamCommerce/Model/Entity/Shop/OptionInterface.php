<?php

namespace DreamCommerce\Model\Entity\Shop;

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