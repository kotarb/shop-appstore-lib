<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Hydrator\Webhook as WebhookHydrator;
use DreamCommerce\Model\Entity\Shop\OrderInterface;
use DreamCommerce\Model\Entity\Shop\ParcelAddressInterface;
use DreamCommerce\Model\Entity\Shop\ParcelInterface;
use DreamCommerce\Model\Entity\Shop\ParcelProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductStockInterface;
use DreamCommerce\Model\Entity\Shop\ShippingInterface;
use DreamCommerce\Model\Entity\Shop\TaxInterface;

class Parcel extends WebhookHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param ParcelInterface $parcel
     * @return object
     */
    public function hydrate(array $data, $parcel)
    {
        $shop = $parcel->getShop();

        if(isset($data['order_id'])) {
            /** @var OrderInterface $order */
            $order = $this->manager->find($shop, 'order', $data['order_id']);
            $parcel->setOrder($order);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }

            /** @var ParcelAddressInterface $billingAddress */
            $billingAddress = $this->manager->find($shop, 'parcelBillingAddress', $data['billingAddress']['address_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $billingAddress->setParcel($parcel);
            $this->fillModel($data['billingAddress'], $billingAddress);
            $parcel->setBillingAddress($billingAddress);
            unset($data['billingAddress']);
        }

        if(isset($data['deliveryAddress'])) {
            if(isset($data['deliveryAddress']['tax_id'])) {
                $data['deliveryAddress']['tax_identification_number'] = $data['deliveryAddress']['tax_id'];
            }

            /** @var ParcelAddressInterface $deliveryAddress */
            $deliveryAddress = $this->manager->find($shop, 'parcelDeliveryAddress', $data['deliveryAddress']['address_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $deliveryAddress->setParcel($parcel);
            $this->fillModel($data['deliveryAddress'], $deliveryAddress);
            $parcel->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = $this->manager->find($shop, 'shipping', $data['shipping']['shipping_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['shipping'], $shipping);
            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = $this->manager->find($shop, 'tax', $data['shipping']['tax_id']);
                $shipping->setTax($tax);
            }

            $parcel->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var ParcelProductInterface $parcelProduct */
                $parcelProduct = $this->manager->find($shop, 'parcelProduct', $productData['id'], true, ModelManager::PROVIDER_WEBHOOK);
                $this->fillModel($productData, $parcelProduct);

                if(isset($productData['product_id'])) {
                    /** @var ProductInterface $product */
                    $product = $this->manager->find($shop, 'product', $productData['product_id']);
                    $parcelProduct->setProduct($product);
                }

                if(isset($productData['stock_id'])) {
                    /** @var ProductStockInterface $productStock */
                    $productStock = $this->manager->find($shop, 'productStock', $productData['stock_id']);
                    $parcelProduct->setProductStock($productStock);
                }

                $parcel->addProduct($parcelProduct);
            }
            unset($data['products']);
        }

        parent::hydrate($data, $parcel);

        return $parcel;
    }
}