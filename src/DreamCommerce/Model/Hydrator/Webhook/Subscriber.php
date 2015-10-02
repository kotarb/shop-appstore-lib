<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Hydrator\Webhook as WebhookHydrator;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Entity\Shop\SubscriberInterface;
use DreamCommerce\Model\Entity\Shop\SubscriberGroupInterface;

class Subscriber extends WebhookHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param SubscriberInterface $subscriber
     * @return object
     */
    public function hydrate(array $data, $subscriber)
    {
        if(!($subscriber instanceof SubscriberInterface)) {
            // throw Exception ...
        }

        $shop = $subscriber->getShop();
        if(isset($data['groups'])) {
            foreach($data['groups'] as $groupData) {
                /** @var SubscriberGroupInterface $subscriberGroup */
                $subscriberGroup = $this->manager->find($shop, 'userGroup', $data['group_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $this->fillModel($groupData, $subscriberGroup);
                $subscriber->addGroup($subscriberGroup);
            }
            unset($data['groups']);
        }

        parent::hydrate($data, $subscriber);

        return $subscriber;
    }
}