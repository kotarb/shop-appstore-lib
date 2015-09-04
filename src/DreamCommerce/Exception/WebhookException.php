<?php

namespace DreamCommerce\Exception;

use DreamCommerce\Exception;

/**
 * Class WebhookException
 *
 * @package DreamCommerce\Exception
 */
class WebhookException extends Exception
{
    /**
     * error occurs when signature of webhook is invalid
     */
    const WEBHOOK_SIGNATURE_INVALID = 1;
}