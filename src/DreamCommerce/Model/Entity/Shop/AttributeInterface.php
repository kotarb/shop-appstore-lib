<?php

namespace DreamCommerce\Model\Entity\Shop;

interface AttributeInterface extends ResourceDependentInterface
{
    /**
     * @return AttributeGroupInterface
     */
    public function getAttributeGroup();

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function setAttributeGroup(AttributeGroupInterface $attributeGroup);
}