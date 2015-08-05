<?php

namespace DreamCommerce\Model\Shop;

/**
 * Interface AdditionalFieldInterface
 * @package DreamCommerce\Model\Shop
 */
interface AdditionalFieldInterface extends ShopDependentInterface
{
    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_CHECKBOX = 2;
    const FIELD_TYPE_SELECT = 3;
    const FIELD_TYPE_FILE = 4;
    const FIELD_TYPE_HIDDEN = 5;
}