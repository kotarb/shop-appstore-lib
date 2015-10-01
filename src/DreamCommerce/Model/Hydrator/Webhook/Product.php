<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Hydrator\Webhook as WebhookHydrator;
use DreamCommerce\Model\Entity\Shop\AvailabilityInterface;
use DreamCommerce\Model\Entity\Shop\CategoryInterface;
use DreamCommerce\Model\Entity\Shop\DeliveryInterface;
use DreamCommerce\Model\Entity\Shop\OptionGroupInterface;
use DreamCommerce\Model\Entity\Shop\ProducerInterface;
use DreamCommerce\Model\Entity\Shop\ProductFileInterface;
use DreamCommerce\Model\Entity\Shop\ProductImageInterface;
use DreamCommerce\Model\Entity\Shop\ProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductStockInterface;
use DreamCommerce\Model\Entity\Shop\ProductTranslationInterface;
use DreamCommerce\Model\Entity\Shop\TaxInterface;
use DreamCommerce\Model\Entity\Shop\UnitInterface;

class Product extends WebhookHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  ProductInterface $product
     * @return object
     */
    public function hydrate(array $data, $product)
    {
        $shop = $product->getShop();

        if(isset($data['producer'])) {
            /** @var ProducerInterface $producer */
            $producer = $this->manager->find($shop, 'producer', $data['producer_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['producer'], $producer);
            $product->setProducer($producer);
            unset($data['producer']);
        } elseif(isset($data['producer_id'])) {
            /** @var ProducerInterface $producer */
            $producer = $this->manager->find($shop, 'producer', $data['producer_id']);
            $product->setProducer($producer);
        }

        if(isset($data['tax'])) {
            /** @var TaxInterface $tax */
            $tax = $this->manager->find($shop, 'tax', $data['tax']['tax_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['tax'], $tax);
            $product->setTax($tax);
            unset($data['tax']);
        } elseif(isset($data['tax_id'])) {
            $tax = $this->manager->find($shop, 'tax', $data['tax_id']);
            $product->setTax($tax);
        }

        if(isset($data['unit'])) {
            /** @var UnitInterface $unit */
            $unit = $this->manager->find($shop, 'unit', $data['unit_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['unit'], $unit);
            $product->setUnit($unit);
            unset($data['unit']);
        } elseif(isset($data['unit_id'])) {
            /** @var UnitInterface $unit */
            $unit = $this->manager->find($shop, 'unit', $data['unit_id']);
            $product->setUnit($unit);
        }

        if(isset($data['category_id'])) {
            /** @var CategoryInterface $category */
            $category = $this->manager->find($shop, 'category', $data['category_id']);
            $product->setCategory($category);
        }

        if(isset($data['group_id'])) {
            /** @var OptionGroupInterface $optionGroup */
            $optionGroup = $this->manager->find($shop, 'optionGroup', $data['group_id']);
            $product->setOptionGroup($optionGroup);
        }

        if(isset($data['specialOffer'])) {

        }

        if(isset($data['translations'])) {
            foreach($data['translations'] as $translationData) {
                /** @var ProductTranslationInterface $translation */
                $translation = $this->manager->find($shop, 'productTranslation', $translationData['translation_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $translation->setProduct($product);
                $this->fillModel($translationData, $translation);
                if(isset($translationData['lang_id'])) {
                    $language = $this->manager->find($shop, 'language', $translationData['lang_id']);
                    $translation->setLanguage($language);
                }
                $product->addTranslation($translation);
            }
            unset($data['translations']);
        }

        if(isset($data['images'])) {
            foreach($data['images'] as $imageData) {
                /** @var ProductImageInterface $image */
                $image = $this->manager->find($shop, 'productImage', $imageData['gfx_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $image->setProduct($product);
                $this->fillModel($imageData, $image);
                $product->addImage($image);
            }
            unset($data['images']);
        }

        if(isset($data['files'])) {
            foreach($data['files'] as $fileData) {
                /** @var ProductTranslationInterface $translation */
                $translation = $this->manager->find($shop, 'productTranslation', $fileData['translation_id'], true, ModelManager::PROVIDER_WEBHOOK);
                /** @var ProductFileInterface $file */
                $file = $this->manager->find('productFile', $fileData['file_id'], $shop);
                $file->setProductTranslation($translation);
                $this->fillModel($fileData, $translation);
                $translation->addFile($file);
            }
            unset($data['files']);
        }

        if(isset($data['stock'])) {
            /** @var ProductStockInterface $productStock */
            $productStock = $this->manager->find($shop, 'productStock', $data['stock']['stock_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $productStock->setProduct($product);
            $this->fillModel($data['stock'], $productStock);

            if(isset($data['stock']['availability'])) {
                /** @var AvailabilityInterface $availability */
                $availability = $this->manager->find($shop, 'availability', $data['availability']['availability_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $this->fillModel($data['availability'], $availability);
                $productStock->setAvailability($availability);
            } elseif($data['stock']['availability_id']) {
                /** @var AvailabilityInterface $availability */
                $availability = $this->manager->find($shop, 'availability', $data['availability_id']);
                $productStock->setAvailability($availability);
            }

            if(isset($data['stock']['delivery'])) {
                /** @var DeliveryInterface $delivery */
                $delivery = $this->manager->find($shop, 'delivery', $data['delivery']['delivery_id'], true, ModelManager::PROVIDER_WEBHOOK);
                $this->fillModel($data['delivery'], $delivery);
                $productStock->setDelivery($delivery);
            } elseif($data['stock']['delivery_id']) {
                /** @var DeliveryInterface $delivery */
                $delivery = $this->manager->find($shop, 'delivery', $data['delivery_id']);
                $productStock->setDelivery($delivery);
            }

            if(isset($data['stock']['gfx_id'])) {
                $image = $this->manager->find($shop, 'productImage', $data['stock']['gfx_id']);
                $productStock->setImage($image);
            }

            if($data['stock']['options']) {
                foreach($data['stock']['options'] as $optionData) {
                    // TODO
                }
            }

            $product->setProductStock($productStock);
            unset($data['stock']);
        }

        $this->fillModel($data, $product);
        return $product;
    }
}