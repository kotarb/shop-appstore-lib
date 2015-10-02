<?php

namespace DreamCommerce\Validator;

use DreamCommerce\Exception\AppstoreException;
use DreamCommerce\Model\AppstoreRequest;
use DreamCommerce\Client\OAuth as OAuthClient;

class AppstorePayload implements ValidatorInterface
{
    /**
     * @param AppstoreRequest $object
     * @return bool
     * @throws AppstoreException
     */
    public function isValid($object)
    {
        if(! $object instanceof AppstoreRequest) {
            throw new AppstoreException('', AppstoreException::APPSTORE_SIGNATURE_INVALID);
        }

        $application = $object->getApplication();

        /** @var OAuthClient $clientHandler */
        $clientHandler = $application->getClientHandler();
        if(!($clientHandler instanceof OAuthClient)) {
            // TODO throw Exception ...
        }

        $payload = array(
            'application' => $application->getApplicationId(),
            'application-version' => $object->getApplicationVersion(),
            'translations' => $object->getTranslations(),
            'locale' => $object->getLocale(),
            'version' => $object->getVersion(),
            'place' => $object->getPlace(),
            'shop' => $object->getShop()->getShopUniqId(),
            'timestamp' => $object->getTimestamp()
        );

        $id = $object->getId();
        if($id) {
            $payload['id'] = $id;
        }

        ksort($payload);

        $processedPayload = array();
        foreach($payload as $k => $v){
            $processedPayload = $k . '=' . $v;
        }

        $processedPayload = join('&', $processedPayload);
        $computedHash = hash_hmac('sha512', $processedPayload, $clientHandler->getAppstoreSecret());

        return $computedHash != $object->getHash();
    }
}