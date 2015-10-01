<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Hydrator\Webhook as WebhookHydrator;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Entity\Shop\LanguageInterface;
use DreamCommerce\Model\Entity\Shop\UserAdditionalFieldInterface;
use DreamCommerce\Model\Entity\Shop\UserAddressInterface;
use DreamCommerce\Model\Entity\Shop\UserGroupInterface;
use DreamCommerce\Model\Entity\Shop\UserInterface;

class Client extends WebhookHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  UserInterface $user
     * @return object
     */
    public function hydrate(array $data, $user)
    {
        $shop = $user->getShop();

        if(isset($data['lang_id'])) {
            /** @var LanguageInterface $language */
            $language = $this->manager->find($shop, 'language', $data['lang_id']);
            $user->setLanguage($language);
        }

        if(isset($data['groups'])) {
            foreach($data['groups'] as $groupData) {
                /** @var UserGroupInterface $userGroup */
                $userGroup = $this->manager->find($shop, 'userGroup', $data['group_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $this->fillModel($groupData, $userGroup);
                $user->addGroup($userGroup);
            }
            unset($data['groups']);
        }

        if(isset($data['addresses'])) {
            foreach($data['addresses'] as $addressData) {
                if(isset($addressData['tax_id'])) {
                    $addressData['tax_identification_number'] = $addressData['tax_id'];
                }

                /** @var UserAddressInterface $userAddress */
                $userAddress = $this->manager->find($shop, 'userAddress', $data['address_book_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $userAddress->setUser($user);
                $this->fillModel($addressData, $userAddress);
                $user->addAddress($userAddress);
            }
            unset($data['addresses']);
        }

        if(isset($data['additional_fields'])) {
            foreach($data['additional_fields'] as $additionalData) {
                /** @var UserAdditionalFieldInterface $additionalField */
                $additionalField = $this->manager->find($shop, 'userAdditionalField', $additionalData['field_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $additionalField->setUser($user);
                $this->fillModel($additionalData, $additionalField);
                $user->addAdditionalField($additionalField);
            }
            unset($data['additional_fields']);
        }

        parent::hydrate($data, $user);

        return $user;
    }
}