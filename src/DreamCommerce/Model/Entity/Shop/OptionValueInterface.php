<?php

namespace DreamCommerce\Model\Entity\Shop;

interface OptionValueInterface extends TranslationDependentInterface, ResourceDependentInterface
{
    /**
     * @return OptionInterface
     */
    public function getOption();

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption(OptionInterface $option);
}