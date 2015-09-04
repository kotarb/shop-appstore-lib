<?php

namespace DreamCommerce\Exception;

use DreamCommerce\Exception;

/**
 * Class ModelException
 *
 * @package DreamCommerce\Exception
 */
class ModelException extends Exception
{
    const UNSUPPORTED_OBJECT_TYPE = 1;

    const SHOP_NOT_SPECIFIED = 2;
}