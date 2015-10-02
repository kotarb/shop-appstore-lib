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
    public function isValid($object)
    {
        if(! $object instanceof WebhookRequest) {
            throw new WebhookException('', WebhookException::WEBHOOK_SIGNATURE_INVALID); // TODO
        }

        $hash = sha1(
            $object->getWebhookId() .
            $object->getWebhook()->getSecret() .
            $object->getData()
        );

        return $hash === $object->getWebhookSignature();
    }
}