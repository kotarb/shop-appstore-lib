<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;

interface ProviderInterface
{
    /**
     * @param string $objectName
     * @param int|null $objectId
     * @param ShopInterface|null $shop
     * @return ShopDependentInterface
     */
    public static function getModel($objectName, $objectId = null, ShopInterface $shop = null);
}