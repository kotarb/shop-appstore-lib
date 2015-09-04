<?php

namespace DreamCommerce\Model\Entity\Shop;

interface ParcelAddressInterface extends AddressInterface
{
    /**
     * @return ParcelInterface
     */
    public function getParcel();

    /**
     * @param ParcelInterface $parcel
     * @return $this
     */
    public function setParcel(ParcelInterface $parcel);
}