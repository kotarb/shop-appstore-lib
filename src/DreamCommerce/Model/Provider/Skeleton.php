<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\Shop\ResourceDependentInterface;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;

class Skeleton implements ProviderInterface
{
    /**
     * @var array
     */
    private static $classMapping = array();

    /**
     * @param string $objectName
     * @param int|null $objectId
     * @param ShopInterface|null $shop
     * @throws ModelException
     * @return ShopDependentInterface
     */
    public static function getModel($objectName, $objectId = null, ShopInterface $shop = null)
    {
        if($shop === null) {
            $shop = ModelManager::getDefaultShop();
        }
        $objectName = ucfirst($objectName);

        if(isset(self::$classMapping[$objectName])) {
            /** @var ShopDependentInterface $object */
            $object = new self::$classMapping[$objectName]();
        } else {
            $className = '\\DreamCommerce\\Model\\Shop\\' . $objectName;
            if (!class_exists($className)) {
                throw new ModelException('Class "' . $className . '" does not exists');
            }
            /** @var ShopDependentInterface $object */
            $object = new $className;
        }

        $object->setShop($shop);

        if($objectId !== null) {
            if ($object instanceof ResourceDependentInterface) {
                /** @var ResourceDependentInterface $object */
                $object->setResourceId($objectId);
            }
        }

        return $object;
    }

    /**
     * @return array
     */
    public static function getClassMapping()
    {
        return self::$classMapping;
    }

    /**
     * @param array $mapping
     */
    public static function setClassMapping(array $mapping = array())
    {
        self::$classMapping = array_merge(self::$classMapping, $mapping);
    }
}