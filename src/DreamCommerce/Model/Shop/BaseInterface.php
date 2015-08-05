<?php

namespace DreamCommerce\Model\Shop;

interface BaseInterface
{
    /**
     * @return ShopInterface
     */
    public function getShop();

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);

    /**
     * @return int
     */
    public function getExternalId();

    /**
     * @param int $id
     * @return $this
     */
    public function setExternalId($id);

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