<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;

interface ProviderInterface
{
    /**
     * @param ShopInterface|null $shop
     * @param string $objectName
     * @param int $objectId
     * @param boolean $fromInstanceCache
     * @return ShopDependentInterface|boolean
     */
    public function find(ShopInterface $shop, $objectName, $objectId = null, $fromInstanceCache = true);

    /**
     * @param ShopDependentInterface $object
     * @return boolean
     */
    public function persist(ShopDependentInterface $object);

    /**
     * @param ShopDependentInterface $object
     * @return boolean
     */
    public function delete(ShopDependentInterface $object);

    /**
     * @param ShopInterface $shop
     * @param string $objectName
     * @param int|null $objectId
     * @param boolean $fromInstanceCache
     */
    public function preFind(ShopInterface $shop, $objectName, $objectId = null, $fromInstanceCache = true);

    /**
     * @param ShopInterface $shop
     * @param string $objectName
     * @param int|null $objectId
     * @param boolean $fromInstanceCache
     * @param ShopDependentInterface|null $object
     */
    public function postFind(ShopInterface $shop, $objectName, $objectId = null, $fromInstanceCache = true, ShopDependentInterface $object);

    /**
     * @param ShopDependentInterface $object
     */
    public function prePersist(ShopDependentInterface $object);

    /**
     * @param ShopDependentInterface $object
     * @param boolean $result
     */
    public function postPersist(ShopDependentInterface $object, $result);

    /**
     * @param ShopDependentInterface $object
     */
    public function preDelete(ShopDependentInterface $object);

    /**
     * @param ShopDependentInterface $object
     * @param boolean $result
     */
    public function postDelete(ShopDependentInterface $object, $result);
}