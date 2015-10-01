<?php

namespace DreamCommerce\Model;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;
use DreamCommerce\Model\Provider\ProviderInterface;
use DreamCommerce\Model\Provider\Skeleton as SkeletonProvider;
use DreamCommerce\Model\Provider\Rest as RestProvider;
use DreamCommerce\Model\Provider\Doctrine as DoctrineProvider;
use DreamCommerce\Model\Provider\Webhook as WebhookProvider;

class Manager
{
    const PROVIDER_SKELETON = 'skeleton';
    const PROVIDER_WEBHOOK = 'webhook';
    const PROVIDER_REST = 'rest';
    const PROVIDER_DOCTRINE = 'doctrine';

    /**
     * @var \SplPriorityQueue
     */
    private $providers;

    /**
     * @var int
     */
    private $serial = PHP_INT_MAX;

    /**
     * @param ShopInterface|null $shop
     * @param string $objectName
     * @param int $objectId
     * @param boolean $fromInstanceCache
     * @return ShopDependentInterface|boolean
     */
    public function find(ShopInterface $shop, $objectName, $objectId, $fromInstanceCache = true)
    {

    }

    /**
     * @param ShopDependentInterface $object
     * @return boolean
     */
    public function persist(ShopDependentInterface $object)
    {

    }

    /**
     * @param $objectName
     * @param int|null $objectId
     * @param ShopInterface|null $shop
     * @param bool $fromCache
     * @param ProviderInterface|string $forceProvider
     * @return ShopDependentInterface
     * @throws ModelException
     */
    public function get($objectName, $objectId = null, ShopInterface $shop = null, $fromCache = true, $forceProvider = null)
    {
        if($forceProvider !== null && (!is_string($forceProvider) && !($forceProvider instanceof ProviderInterface))) {
            throw new ModelException();
        }

        if($shop === null) {
            $shop = self::getShop();
        }

        $objectName = ucfirst($objectName);
        $shopUniqId = $shop->getShopUniqId();

        if($fromCache && $objectId !== null) {
            if (!isset($this->models[$shopUniqId])) {
                $this->models[$shopUniqId] = array();
            }

            if (!isset($this->models[$shopUniqId][$objectName])) {
                $this->models[$shopUniqId][$objectName] = array();
            }

            if (isset($this->models[$shopUniqId][$objectName][$objectId])) {
                return $this->models[$shopUniqId][$objectName][$objectId];
            }
        }

        /** @var ShopDependentInterface $object */
        $object = null;
        foreach(clone self::getProviders() as $provider) {
            if($provider !== null) {
                if(is_string($forceProvider)) {
                    if(
                        ($forceProvider == self::PROVIDER_SKELETON && $provider instanceof SkeletonProvider) ||
                        ($forceProvider == self::PROVIDER_REST && $provider instanceof RestProvider) ||
                        ($forceProvider == self::PROVIDER_DOCTRINE && $provider instanceof DoctrineProvider)
                    ) {
                        /** @var ProviderInterface $provider */
                        $object = $provider->getModel($objectName, $objectId, $shop);
                        if($object !== false) {
                            $object->setProvider($provider);
                            return $object;
                        }
                        break;
                    }
                } elseif($provider instanceof ProviderInterface) {
                    $className = get_class($provider);
                    $forceClassName = get_class($forceProvider);

                    if($className === $forceClassName) {
                        /** @var ProviderInterface $provider */
                        $object = $provider->getModel($objectName, $objectId, $shop);
                        if($object !== false) {
                            $object->setProvider($provider);
                            return $object;
                        }
                        break;
                    }
                }
            } else {
                /** @var ProviderInterface $provider */
                $object = $provider->find($shop, $objectName, $objectId);
                if($object !== false) {
                    $object->setProvider($provider);
                    return $object;
                }
            }
        }

        if($object === null) {
            throw new ModelException();
        }

        return $object;
    }

    /**
     * @param string|ProviderInterface $provider
     * @param array|int $priority
     * @throws ModelException
     */
    public function registerProvider($provider, $priority = 10)
    {
        if(is_string($provider)) {
            switch($provider) {
                case self::PROVIDER_SKELETON:
                    $provider = new SkeletonProvider();
                    break;
                case self::PROVIDER_REST:
                    $provider = new RestProvider();
                    break;
                case self::PROVIDER_DOCTRINE:
                    $provider = new DoctrineProvider();
                    break;
                case self::PROVIDER_WEBHOOK:
                    $provider = new WebhookProvider();
                    break;
            }
        }

        if(! $provider instanceof ProviderInterface) {
            throw new ModelException();
        }

        if (!is_array($priority)) {
            $priority = array($priority, $this->serial--);
        }

        $this->providers->insert($provider, $priority);
    }

    /**
     * @return \SplPriorityQueue
     */
    public function getProviders()
    {
        if($this->providers === null) {
            $this->providers = new \SplPriorityQueue();
        }

        return $this->providers;
    }
}