<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;

class Doctrine extends Skeleton
{
    /**
     * {@inheritdoc}
     */
    public function find(ShopInterface $shop, $objectName, $objectId)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(ShopDependentInterface $object)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function persist(ShopDependentInterface $object)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function postPersist(ShopDependentInterface $object)
    {

    }
}