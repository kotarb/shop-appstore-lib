<?php

namespace DreamCommerce\Model;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;
use DreamCommerce\Model\Provider\ProviderInterface;
use DreamCommerce\Model\Provider\Skeleton as SkeletonProvider;
use DreamCommerce\Model\Provider\Rest as RestProvider;
use DreamCommerce\Model\Provider\Doctrine as DoctrineProvider;

class Manager
{
    const PROVIDER_SKELETON = 'skeleton';
    const PROVIDER_REST = 'rest';
    const PROVIDER_DOCTRINE = 'doctine';

    /**
     * @var ShopInterface
     */
    private static $shop;

    /**
     * @var array
     */
    private static $models = array();

    /**
     * @var \SplPriorityQueue
     */
    private static $providers;

    /**
     * @var int
     */
    private static $serial = PHP_INT_MAX;

    /**
     * Disable constructor
     */
    private function __construct()
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
    public static function getModel($objectName, $objectId = null, ShopInterface $shop = null, $fromCache = true, $forceProvider = null)
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
            if (!isset(self::$models[$shopUniqId])) {
                self::$models[$shopUniqId] = array();
            }

            if (!isset(self::$models[$shopUniqId][$objectName])) {
                self::$models[$shopUniqId][$objectName] = array();
            }

            if (isset(self::$models[$shopUniqId][$objectName][$objectId])) {
                return self::$models[$shopUniqId][$objectName][$objectId];
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
                $object = $provider->getModel($objectName, $objectId, $shop);
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
     * @param ShopInterface|null $shop
     * @param string|null $objectName
     * @param int|null $objectId
     * @return bool
     */
    public static function cleanModels(ShopInterface $shop = null, $objectName = null, $objectId = null)
    {
        $objectName = ucfirst($objectName);

        if($shop === null) {
            self::$models = array();
            return true;
        }

        $shopUniqId = $shop->getShopUniqId();
        if($objectName === null) {
            if(isset(self::$models[$shopUniqId])) {
                self::$models[$shopUniqId] = array();
                return true;
            }
        } elseif($objectId === null) {
            if(isset(self::$models[$shopUniqId]) && isset(self::$models[$shopUniqId][$objectName])) {
                self::$models[$shopUniqId][$objectName] = array();
                return true;
            }
        } else {
            if(isset(self::$models[$shopUniqId]) && isset(self::$models[$shopUniqId][$objectName]) && isset(self::$models[$shopUniqId][$objectName][$objectId])) {
                unset(self::$models[$shopUniqId][$objectName][$objectId]);
                return true;
            }
        }

        return false;
    }

    /**
     * @throws ModelException
     * @return ShopInterface
     */
    public static function getDefaultShop()
    {
        if(self::$shop === null) {
            throw new ModelException('Default shop is not specified', ModelException::SHOP_NOT_SPECIFIED);
        }

        return self::$shop;
    }

    /**
     * @param ShopInterface $shop
     */
    public static function setDefaultShop(ShopInterface $shop)
    {
        self::$shop = $shop;
    }

    /**
     * @param string|ProviderInterface $provider
     * @param array|int $priority
     * @throws ModelException
     */
    public static function registerProvider($provider, $priority = 10)
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
            }
        }

        if(! $provider instanceof ProviderInterface) {
            throw new ModelException();
        }

        if (!is_array($priority)) {
            $priority = array($priority, self::$serial--);
        }

        self::$providers->insert($provider, $priority);
    }

    /**
     * @return \SplPriorityQueue
     */
    public static function getProviders()
    {
        if(self::$providers === null) {
            self::$providers = new \SplPriorityQueue();
        }

        return self::$providers;
    }
}