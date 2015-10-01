<?php

namespace DreamCommerce\Validator;

use DreamCommerce\Exception\WebhookException;
use DreamCommerce\Model\WebhookRequest;

class WebhookSignature implements ValidatorInterface
{
    /**
     * @param WebhookRequest $object
     * @return bool
     * @throws WebhookException
     */
    public function valid($object)
    {
        if(! $object instanceof WebhookRequest) {
            throw new WebhookException('', WebhookException::WEBHOOK_SIGNATURE_INVALID);
        }

        $hash = sha1(
            $object->getWebhookId() .
            $object->getWebhook()->getSecret() .
            $object->getData()
        );

        return $hash === $object->getWebhookSignature();
    }
}