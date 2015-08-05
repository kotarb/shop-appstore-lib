<?php

namespace DreamCommerce\Model\Shop;

abstract class ResourceDependent extends ShopDependent implements ResourceDependentInterface
{
    /**
     * @return \DateTime|null
     * @throws \RuntimeException
     */
    public function getCreationDate()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @param \DateTime|null $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @return \DateTime|null
     */
    public function getModificationDate()
    {
        throw new \RuntimeException('Not implemented yet!');
    }

    /**
     * @param \DateTime|null $modificationDate
     * @return $this
     */
    public function setModificationDate($modificationDate)
    {
        throw new \RuntimeException('Not implemented yet!');
    }
}