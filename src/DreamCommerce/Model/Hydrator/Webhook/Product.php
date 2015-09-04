<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Hydrator\Base as BaseHydrator;
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

class Product extends BaseHydrator
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
            $producer = ModelManager::getModel('producer', $data['producer_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['producer'], $producer);
            $product->setProducer($producer);
            unset($data['producer']);
        } elseif(isset($data['producer_id'])) {
            /** @var ProducerInterface $producer */
            $producer = ModelManager::getModel('producer', $data['producer_id'], $shop);
            $product->setProducer($producer);
        }

        if(isset($data['tax'])) {
            /** @var TaxInterface $tax */
            $tax = ModelManager::getModel('tax', $data['tax']['tax_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['tax'], $tax);
            $product->setTax($tax);
            unset($data['tax']);
        } elseif(isset($data['tax_id'])) {
            $tax = ModelManager::getModel('tax', $data['tax_id'], $shop);
            $product->setTax($tax);
        }

        if(isset($data['unit'])) {
            /** @var UnitInterface $unit */
            $unit = ModelManager::getModel('unit', $data['unit_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['unit'], $unit);
            $product->setUnit($unit);
            unset($data['unit']);
        } elseif(isset($data['unit_id'])) {
            /** @var UnitInterface $unit */
            $unit = ModelManager::getModel('unit', $data['unit_id'], $shop);
            $product->setUnit($unit);
        }

        if(isset($data['category_id'])) {
            /** @var CategoryInterface $category */
            $category = ModelManager::getModel('category', $data['category_id'], $shop);
            $product->setCategory($category);
        }

        if(isset($data['group_id'])) {
            /** @var OptionGroupInterface $optionGroup */
            $optionGroup = ModelManager::getModel('optionGroup', $data['group_id'], $shop);
            $product->setOptionGroup($optionGroup);
        }

        if(isset($data['specialOffer'])) {

        }

        if(isset($data['translations'])) {
            foreach($data['translations'] as $translationData) {
                /** @var ProductTranslationInterface $translation */
                $translation = ModelManager::getModel('productTranslation', $translationData['translation_id'], $shop, ModelManager::PROVIDER_SKELETON);
                $translation->setProduct($product);
                $this->fillModel($translationData, $translation);
                if(isset($translationData['lang_id'])) {
                    $language = ModelManager::getModel('language', $translationData['lang_id'], $shop);
                    $translation->setLanguage($language);
                }
                $product->addTranslation($translation);
            }
            unset($data['translations']);
        }

        if(isset($data['images'])) {
            foreach($data['images'] as $imageData) {
                /** @var ProductImageInterface $image */
                $image = ModelManager::getModel('productImage', $imageData['gfx_id'], $shop, ModelManager::PROVIDER_SKELETON);
                $image->setProduct($product);
                $this->fillModel($imageData, $image);
                $product->addImage($image);
            }
            unset($data['images']);
        }

        if(isset($data['files'])) {
            foreach($data['files'] as $fileData) {
                /** @var ProductTranslationInterface $translation */
                $translation = ModelManager::getModel('productTranslation', $fileData['translation_id'], $shop, ModelManager::PROVIDER_SKELETON);
                /** @var ProductFileInterface $file */
                $file = ModelManager::getModel('productFile', $fileData['file_id'], $shop);
                $file->setProductTranslation($translation);
                $this->fillModel($fileData, $translation);
                $translation->addFile($file);
            }
            unset($data['files']);
        }

        if(isset($data['stock'])) {
            /** @var ProductStockInterface $productStock */
            $productStock = ModelManager::getModel('productStock', $data['stock']['stock_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $productStock->setProduct($product);
            $this->fillModel($data['stock'], $productStock);

            if(isset($data['stock']['availability'])) {
                /** @var AvailabilityInterface $availability */
                $availability = ModelManager::getModel('availability', $data['availability']['availability_id'], $shop, ModelManager::PROVIDER_SKELETON);
                $this->fillModel($data['availability'], $availability);
                $productStock->setAvailability($availability);
            } elseif($data['stock']['availability_id']) {
                /** @var AvailabilityInterface $availability */
                $availability = ModelManager::getModel('availability', $data['availability_id'], $shop);
                $productStock->setAvailability($availability);
            }

            if(isset($data['stock']['delivery'])) {
                /** @var DeliveryInterface $delivery */
                $delivery = ModelManager::getModel('delivery', $data['delivery']['delivery_id'], $shop, ModelManager::PROVIDER_SKELETON);
                $this->fillModel($data['delivery'], $delivery);
                $productStock->setDelivery($delivery);
            } elseif($data['stock']['delivery_id']) {
                /** @var DeliveryInterface $delivery */
                $delivery = ModelManager::getModel('delivery', $data['delivery_id'], $shop);
                $productStock->setDelivery($delivery);
            }

            if(isset($data['stock']['gfx_id'])) {
                $image = ModelManager::getModel('productImage', $data['stock']['gfx_id'], $shop);
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