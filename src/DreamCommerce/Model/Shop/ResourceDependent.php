<?php

namespace DreamCommerce\Model\Shop;

abstract class ResourceDependent extends Base implements ResourceDependentInterface
{
    /**
     * @return string
     */
    public function getResourceName()
    {
        return null;
    }
}