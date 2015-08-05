<?php

namespace DreamCommerce\Model\Shop;

interface ResourceDependentInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getResourceName();
}