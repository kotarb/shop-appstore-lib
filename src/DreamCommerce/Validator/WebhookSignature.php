<?php

namespace DreamCommerce\Validator;

use DreamCommerce\Exception\WebhookException;
use DreamCommerce\Model\Entity\WebhookRequestInterface;

class WebhookSignature implements ValidatorInterface
{
    /**
     * @param WebhookRequestInterface $object
     * @return bool
     * @throws WebhookException
     */
    public function valid($object)
    {
        if(! $object instanceof WebhookRequestInterface) {
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