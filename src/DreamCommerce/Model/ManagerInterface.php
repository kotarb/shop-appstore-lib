<?php

namespace DreamCommerce\Model;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;
use DreamCommerce\Model\Provider\ProviderInterface;

interface ManagerInterface
{
    /**
     * @param ShopInterface|null $shop
     * @param string $objectName
     * @param int $objectId
     * @param null|string|ProviderInterface $forceProvider
     * @return ShopDependentInterface|boolean
     */
    public function find(ShopInterface $shop, $objectName, $objectId, $forceProvider = null);

    /**
     * @param ShopDependentInterface $object
     * @return boolean
     */
    public function persist(ShopDependentInterface $object);

    /**
     * @param ShopDependentInterface $object
     * @return boolean
     */
    public function flush(ShopDependentInterface $object = null);

    /**
     * @param string|ProviderInterface $provider
     * @param array|int $priority
     * @throws ModelException
     */
    public function registerProvider($provider, $priority = 10);

    /**
     * @return \SplPriorityQueue
     */
    public function getProviders();
}