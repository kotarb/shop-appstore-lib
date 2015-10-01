<?php

namespace DreamCommerce\Model\Provider;

use DreamCommerce\ClientInterface;
use DreamCommerce\Exception;
use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\Shop\ResourceDependentInterface;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;
use DreamCommerce\Resource;
use DreamCommerce\Model\Hydrator\Rest as RestHydrator;
use DreamCommerce\Model\Provider\Webhook as WebhookProvider;

class Rest extends Skeleton
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var RestHydrator
     */
    private $hydrator;

    /**
     * @var array
     */
    private $resources = array();

    public function __construct()
    {
        $this->hydrator = new RestHydrator();
    }

    /**
     * {@inheritdoc}
     */
    public function find(ShopInterface $shop, $objectName, $objectId = null, $fromInstanceCache = true)
    {
        if($fromInstanceCache) {
            $object = $this->getInstanceCache($shop, $objectName, $objectId);
            if($object !== null) {
                return $object;
            }
        }

        $this->preFind($shop, $objectName, $objectId, $fromInstanceCache);

        $className = $this->getClass($objectName);
        $reflection = new \ReflectionClass($className);
        if(!$reflection->implementsInterface('\\DreamCommerce\\Model\\Entity\\Shop\\ResourceDependentInterface')) {
            $this->postFind($shop, $objectName, $objectId, $fromInstanceCache, false);
            return false;
        }

        /** @var ResourceDependentInterface $object */
        $object = new $className();

        /** @var Resource $resource */
        $resource = $this->getResourceByObject($object);
        $result = $resource->get($objectId);

        $this->hydrator->hydrate($result, $object);

        $this->postFind($shop, $objectName, $objectId, $fromInstanceCache, $object);

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public function persist(ShopDependentInterface $object)
    {
        $this->prePersist($object);

        if(! $object instanceof ResourceDependentInterface) {
            $this->postPersist($object, false);
            return false;
        }

        if(! $object->getProvider() instanceof WebhookProvider) {
            $this->postPersist($object, false);
            return false;
        }

        /** @var Resource $resource */
        $resource = $this->getResourceByObject($object);
        $resourceData = $this->hydrator->extract($object);
        $resourceId = $object->getResourceId();

        if($resourceId === null) {
            $resourceId = $resource->post($resourceData);
            $object->setResourceId($resourceId);
        } else {
            $resource->put($resourceId, $resourceData);
        }

        $this->postPersist($object, true);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ShopDependentInterface $object)
    {
        $this->preDelete($object);

        if(! $object instanceof ResourceDependentInterface) {
            $this->postDelete($object, false);
            return false;
        }

        if(! $object->getProvider() instanceof WebhookProvider) {
            $this->postPersist($object, false);
            return false;
        }

        $resourceId = $object->getResourceId();
        if($resourceId === null) {
            throw new ModelException();
        }

        $resource = $this->getResourceByObject($object);
        $resource->delete($resourceId);

        $this->postDelete($object, true);

        return true;
    }

    /**
     * @param ResourceDependentInterface $object
     * @return Resource
     * @throws ModelException
     */
    protected function getResourceByObject(ResourceDependentInterface $object)
    {
        $resourceName = $object->getResourceClassName();
        if(!isset($this->resources[$resourceName])) {
            $resource = new $resourceName($this->getClient());
            if(! $resource instanceof Resource) {
                throw new ModelException();
            }
            $this->resources[$resourceName] = $resource;
        }

        return $this->resources[$resourceName];
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        if($this->client === null) {
            throw new Exception();
        }

        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
}