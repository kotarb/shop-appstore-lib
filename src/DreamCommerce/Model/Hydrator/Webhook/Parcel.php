<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Hydrator\Base as BaseHydrator;
use DreamCommerce\Model\Entity\Shop\OrderInterface;
use DreamCommerce\Model\Entity\Shop\ParcelAddressInterface;
use DreamCommerce\Model\Entity\Shop\ParcelInterface;
use DreamCommerce\Model\Entity\Shop\ParcelProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductStockInterface;
use DreamCommerce\Model\Entity\Shop\ShippingInterface;
use DreamCommerce\Model\Entity\Shop\TaxInterface;

class Parcel extends BaseHydrator
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
            $order = ModelManager::getModel('order', $data['order_id'], $shop);
            $parcel->setOrder($order);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }

            /** @var ParcelAddressInterface $billingAddress */
            $billingAddress = ModelManager::getModel('parcelBillingAddress', $data['billingAddress']['address_id'], $shop, ModelManager::PROVIDER_SKELETON);
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
            $deliveryAddress = ModelManager::getModel('parcelDeliveryAddress', $data['deliveryAddress']['address_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $deliveryAddress->setParcel($parcel);
            $this->fillModel($data['deliveryAddress'], $deliveryAddress);
            $parcel->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = ModelManager::getModel('shipping', $data['shipping']['shipping_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['shipping'], $shipping);
            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = ModelManager::getModel('tax', $data['shipping']['tax_id'], $shop);
                $shipping->setTax($tax);
            }

            $parcel->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var ParcelProductInterface $parcelProduct */
                $parcelProduct = ModelManager::getModel('parcelProduct', $productData['id'], $shop, ModelManager::PROVIDER_SKELETON);
                $this->fillModel($productData, $parcelProduct);

                if(isset($productData['product_id'])) {
                    /** @var ProductInterface $product */
                    $product = ModelManager::getModel('product', $productData['product_id'], $shop);
                    $parcelProduct->setProduct($product);
                }

                if(isset($productData['stock_id'])) {
                    /** @var ProductStockInterface $productStock */
                    $productStock = ModelManager::getModel('productStock', $productData['stock_id'], $shop);
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