<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

interface ResourceDependentInterface extends ShopDependentInterface
{
    /**
     * @return string
     */
    public function getResourceClassName();

    /**
     * @return int
     */
    public function getResourceId();

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id);

    /**
     * @return \DateTime|null
     */
    public function getCreationDate();

    /**
     * @param \DateTime|null $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate);

    /**
     * @return \DateTime|null
     */
    public function getModificationDate();

    /**
     * @param \DateTime|null $modificationDate
     * @return $this
     */
    public function setModificationDate($modificationDate);

}