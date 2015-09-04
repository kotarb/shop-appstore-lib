<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

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