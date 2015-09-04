<?php

namespace DreamCommerce\Model\Hydrator;

use DreamCommerce\Model\Entity\ShopDependentInterface;
use Zend\Stdlib\Hydrator\AbstractHydrator;

abstract class Base extends AbstractHydrator
{
    /**
     * @param array $data
     * @param ShopDependentInterface $object
     * @return ShopDependentInterface
     */
    public function hydrate(array $data, $object)
    {
        $this->fillModel($data, $object);
        return $object;
    }

    /**
     * @param ShopDependentInterface $object
     * @return array
     */
    public function extract($object)
    {
        return array();
    }

    protected function fillModel(array $data, ShopDependentInterface $object)
    {
        $reflection = new \ReflectionObject($object);

        foreach($data as $propertyName => $propertyValue) {
            // underscore
            $funcName = 'set' . ucfirst($propertyName);
            if(method_exists($object, $funcName)) {
                $object->$funcName($propertyValue);
                continue;
            }

            $property = $reflection->getProperty($propertyName);
            if($property->isPublic()) {
                $object->$propertyName = $propertyValue;
                continue;
            }

            // camelcase
            $propertyName = $this->underscoreToCamelCase($propertyName);
            $funcName = 'set' . ucfirst($propertyName);
            if(method_exists($object, $funcName)) {
                $object->$funcName($propertyValue);
                continue;
            }

            $property = $reflection->getProperty($propertyName);
            if($property->isPublic()) {
                $object->$propertyName = $propertyValue;
            }
        }
    }

    protected function underscoreToCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
}