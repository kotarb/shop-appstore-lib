<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\Shop\ResourceDependentInterface;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;

class Skeleton implements ProviderInterface
{
    private $instances = array();

    /**
     * @var array
     */
    private static $classMapping = array();

    /**
     * {@inheritdoc}
     * @throws ModelException
     */
    public function find(ShopInterface $shop, $objectName, $objectId, $fromInstanceCache = false)
    {
        $this->preFind($shop, $objectName, $objectId);

        $classname = self::getClass($objectName);
        /** @var ShopDependentInterface $object */
        $object = new $classname();
        if(! $object instanceof ShopDependentInterface) {
            throw new ModelException();
        }
        $object->setShop($shop);

        if ($object instanceof ResourceDependentInterface) {
            /** @var ResourceDependentInterface $object */
            $object->setResourceId($objectId);
        }

        $this->postFind($shop, $objectName, $objectId, $object);
        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public function persist(ShopDependentInterface $object)
    {
        $this->prePersist($object);

        // do nothing ...

        $this->postPersist($object, true);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ShopDependentInterface $object)
    {
        $this->preDelete($object);

        // do nothing ...

        $this->postDelete($object, true);

        return true;
    }


    /**
     * @param ShopInterface $shop
     * @param $objectName
     * @param $objectId
     * @return ShopDependentInterface|boolean
     */
    public function getInstanceCache(ShopInterface $shop, $objectName, $objectId)
    {

    }

    /**
     * @param ShopInterface|null $shop
     * @param string|null $objectName
     * @param integer|null $objectId
     * @return boolean
     */
    public function cleanInstanceCache(ShopInterface $shop = null, $objectName = null, $objectId = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function preFind(ShopInterface $shop, $objectName, $objectId = null)
    {
        // do nothing ...
    }

    /**
     * {@inheritdoc}
     */
    public function postFind(ShopInterface $shop, $objectName, $objectId = null, ShopDependentInterface $object)
    {
        // do nothing ...
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist(ShopDependentInterface $object)
    {
        // do nothing ...
    }

    /**
     * {@inheritdoc}
     */
    public function postPersist(ShopDependentInterface $object, $result)
    {
        // do nothing ...
    }

    /**
     * {@inheritdoc}
     */
    public function preDelete(ShopDependentInterface $object)
    {
        // do nothing ...
    }

    /**
     * {@inheritdoc}
     */
    public function postDelete(ShopDependentInterface $object, $result)
    {
        // do nothing ...
    }


    /**
     * @param string $objectName
     * @return string
     * @throws ModelException
     */
    public static function getClass($objectName)
    {
        $objectName = ucfirst($objectName);

        if(isset(self::$classMapping[$objectName])) {
            $className = self::$classMapping[$objectName];
        } else {
            $className = '\\DreamCommerce\\Model\\Shop\\' . $objectName;
        }

        if (!class_exists($className)) {
            throw new ModelException('Class "' . $className . '" does not exists');
        }

        return $className;
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