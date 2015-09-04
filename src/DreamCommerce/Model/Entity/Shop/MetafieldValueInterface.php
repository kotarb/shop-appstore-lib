<?php

namespace DreamCommerce\Model\Entity\Shop;

interface MetafieldValueInterface extends ResourceDependentInterface
{
    /**
     * @return MetafieldInterface
     */
    public function getMetafield();

    /**
     * @param MetafieldInterface $metafield
     * @return $this
     */
    public function setMetafield(MetafieldInterface $metafield);
}