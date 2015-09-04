<?php

namespace DreamCommerce\Model\Entity\Shop;

interface ProductFileInterface extends ResourceDependentInterface
{
    /**
     * @return ProductTranslationInterface
     */
    public function getProductTranslation();

    /**
     * @param ProductTranslationInterface $productTranslation
     * @return $this
     */
    public function setProductTranslation(ProductTranslationInterface $productTranslation);
}