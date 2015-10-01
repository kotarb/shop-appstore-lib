<?php

namespace DreamCommerce\Validator;

use DreamCommerce\Exception\WebhookException;
use DreamCommerce\Model\Entity\WebhookRequestInterface;

class AppstorePayload implements ValidatorInterface
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

        // sort params
        ksort($payload);

        $processedPayload = "";

        foreach($payload as $k => $v){
            $processedPayload .= '&'.$k.'='.$v;
        }

        $processedPayload = substr($processedPayload, 1);
        $computedHash = hash_hmac('sha512', $processedPayload, $this->appStoreSecret);

        return $computedHash != $providedHash;
    }
}