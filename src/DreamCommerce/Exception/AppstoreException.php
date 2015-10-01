<?php

namespace DreamCommerce\Exception;

use DreamCommerce\Exception;

/**
 * Class AppstoreException
 *
 * @package DreamCommerce\Exception
 */
class AppstoreException extends Exception
{
    /**
     * error occurs when signature of appstore request is invalid
     */
    const APPSTORE_SIGNATURE_INVALID = 1;
}