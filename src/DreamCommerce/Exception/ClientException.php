<?php

namespace DreamCommerce\Exception;

use DreamCommerce\Exception;

/**
 * Class ClientException
 *
 * @package DreamCommerce\Exception
 */
class ClientException extends Exception
{
    /**
     * error occurs when cannot determine more detailed information
     */
    const UNKNOWN_ERROR = 1;
    /**
     * specified URL is invalid
     */
    const ENTRYPOINT_URL_INVALID = 2;
    /**
     * server responded with some error, see exception's message
     */
    const API_ERROR = 3;
    /**
     * you specified something else than get, post, put, delete
     */
    const METHOD_NOT_SUPPORTED = 4;
}