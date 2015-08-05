<?php

namespace DreamCommerce\Model\Shop;

class Metafield extends ResourceDependent implements MetafieldInterface
{
    /**
     * @var int
     */
    protected $metafieldId;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var MetafieldValueInterface
     */
    protected $metafieldValue;

    /**
     * @var ResourceInterface|string
     */
    protected $object;

    /**
     * @return int
     */
    public function getMetafieldId()
    {
        return $this->metafieldId;
    }

    /**
     * @param int $metafieldId
     * @return $this
     */
    public function setMetafieldId($metafieldId)
    {
        $this->metafieldId = $metafieldId;
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return MetafieldValueInterface
     */
    public function getMetafieldValue()
    {
        return $this->metafieldValue;
    }

    /**
     * @param MetafieldValueInterface $metafieldValue
     * @return $this
     */
    public function setMetafieldValue(MetafieldValueInterface $metafieldValue)
    {
        $this->metafieldValue = $metafieldValue;
        return $this;
    }

    /**
     * @return ResourceInterface|string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param ResourceInterface|string $object
     * @return $this
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }
}