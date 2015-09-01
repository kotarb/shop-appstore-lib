<?php

namespace DreamCommerce\Model\Shop;

interface AdditionalFieldTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField();

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField);
}