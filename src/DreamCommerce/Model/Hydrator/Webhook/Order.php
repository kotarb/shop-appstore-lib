<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Hydrator\Base as BaseHydrator;
use DreamCommerce\Model\Manager as ModelManager;
use DreamCommerce\Model\Entity\Shop\AuctionInterface;
use DreamCommerce\Model\Entity\Shop\AuctionOrderInterface;
use DreamCommerce\Model\Entity\Shop\CurrencyInterface;
use DreamCommerce\Model\Entity\Shop\LanguageInterface;
use DreamCommerce\Model\Entity\Shop\OrderAdditionalFieldInterface;
use DreamCommerce\Model\Entity\Shop\OrderAddressInterface;
use DreamCommerce\Model\Entity\Shop\OrderInterface;
use DreamCommerce\Model\Entity\Shop\OrderProductInterface;
use DreamCommerce\Model\Entity\Shop\PaymentInterface;
use DreamCommerce\Model\Entity\Shop\PaymentTranslationInterface;
use DreamCommerce\Model\Entity\Shop\ProductInterface;
use DreamCommerce\Model\Entity\Shop\ProductStockInterface;
use DreamCommerce\Model\Entity\Shop\PromoCodeInterface;
use DreamCommerce\Model\Entity\Shop\ShippingInterface;
use DreamCommerce\Model\Entity\Shop\StatusTranslationInterface;
use DreamCommerce\Model\Entity\Shop\StatusInterface;
use DreamCommerce\Model\Entity\Shop\TaxInterface;
use DreamCommerce\Model\Entity\Shop\UserInterface;

class Order extends BaseHydrator
{
    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  OrderInterface $order
     * @return object
     */
    public function hydrate(array $data, $order)
    {
        $shop = $order->getShop();
        
        if(isset($data['user_id']) && is_null($data['user_id'])) {
            /** @var UserInterface $user */
            $user = ModelManager::getModel('user', $data['user_id'], $shop);
            $order->setUser($user);
        }

        if(isset($data['currency_id'])) {
            /** @var CurrencyInterface $currency */
            $currency = ModelManager::getModel('currency', $data['currency_id'], $shop);
            $order->setCurrency($currency);
        }

        if(isset($data['lang_id'])) {
            /** @var LanguageInterface $language */
            $language = ModelManager::getModel('language', $data['lang_id'], $shop);
            $order->setLanguage($language);
        }

        if(isset($data['code_id'])) {
            /** @var PromoCodeInterface $promoCode */
            $promoCode = ModelManager::getModel('promoCode', $data['code_id'], $shop);
            $order->setPromoCode($promoCode);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }
            /** @var OrderAddressInterface $billingAddress */
            $billingAddress = ModelManager::getModel('orderBillingAddress', $data['billingAddress']['address_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $billingAddress->setOrder($order);
            $this->fillModel($data['billingAddress'], $billingAddress);
            $order->setBillingAddress($billingAddress);
            unset($data['billingAddress']);
        }

        if(isset($data['deliveryAddress'])) {
            if(isset($data['deliveryAddress']['tax_id'])) {
                $data['deliveryAddress']['tax_identification_number'] = $data['deliveryAddress']['tax_id'];
            }
            /** @var OrderAddressInterface $deliveryAddress */
            $deliveryAddress = ModelManager::getModel('orderDeliveryAddress', $data['deliveryAddress']['address_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $deliveryAddress->setOrder($order);
            $this->fillModel($data['deliveryAddress'], $deliveryAddress);
            $order->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['auction'])) {
            /** @var AuctionOrderInterface $auctionOrder */
            $auctionOrder = ModelManager::getModel('auctionOrder', $data['auction']['auction_order_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $auctionOrder->setOrder($order);
            $this->fillModel($data['auction'], $auctionOrder);
            $order->setAuctionOrder($auctionOrder);

            /** @var AuctionInterface $auction */
            $auction = ModelManager::getModel('auction', $data['auction']['auction_id'], $shop);
            $auctionOrder->setAuction($auction);
            unset($data['auction']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = ModelManager::getModel('shipping', $data['shipping_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['shipping'], $shipping);

            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = ModelManager::getModel('tax', $data['shipping']['tax_id'], $shop);
                $shipping->setTax($tax);
            }
            $order->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['status'])) {
            /** @var StatusInterface $status */
            $status = ModelManager::getModel('status', $data['status_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['status'], $status);
            $order->setStatus($status);

            /** @var StatusTranslationInterface $statusTranslation */
            $statusTranslation = ModelManager::getModel('statusTranslation', null, $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel(array(
                'status_id' => $data['status']['status_id'],
                'lang_id' => $data['lang_id'],
                'name' => $data['status']['name'],
                'message' => $data['status']['message']
            ), $statusTranslation);
            $statusTranslation->setStatus($status);
            $status->addTranslation($statusTranslation);

            unset($data['status']);
        }

        if(isset($data['payment'])) {
            /** @var PaymentInterface $payment */
            $payment = ModelManager::getModel('payment', $data['payment_id'], $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel($data['payment'], $payment);
            $order->setPayment($payment);

            /** @var PaymentTranslationInterface $paymentTranslation */
            $paymentTranslation = ModelManager::getModel('paymentTranslation', null, $shop, ModelManager::PROVIDER_SKELETON);
            $this->fillModel(array(
                'lang_id' => $data['lang_id'],
                'payment_id' => $data['payment']['payment_id'],
                'title' => $data['payment']['title'],
                'description' => $data['payment']
            ), $paymentTranslation);

            /** @var LanguageInterface $language */
            $language = ModelManager::getModel('language', $data['lang_id'], $shop);
            $paymentTranslation->setLanguage($language);
            $paymentTranslation->setPayment($payment);
            $payment->addTranslation($paymentTranslation);

            unset($data['payment']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var OrderProductInterface $orderProduct */
                $orderProduct = ModelManager::getModel('orderProduct', $productData['id'], $shop, ModelManager::PROVIDER_SKELETON);
                $orderProduct->setOrder($order);

                /** @var ProductInterface $product */
                $product = ModelManager::getModel('product', $productData['product_id'], $shop);
                $orderProduct->setProduct($product);

                /** @var ProductStockInterface $productStock */
                $productStock = ModelManager::getModel('productStock', $productData['stock_id'], $shop);
                $orderProduct->setProductStock($productStock);

                $this->fillModel($productData, $orderProduct);
                $order->addProduct($orderProduct);
            }
            unset($data['products']);
        }

        if(isset($data['additional_fields'])) {
            foreach($data['additional_fields'] as $additionalData) {
                /** @var OrderAdditionalFieldInterface $additionalField */
                $additionalField = ModelManager::getModel('orderAdditionalField', $additionalData['field_id'], $shop, ModelManager::PROVIDER_SKELETON);
                $additionalField->setOrder($order);

                $this->fillModel($additionalData, $additionalField);
                $order->addAdditionalField($additionalField);
            }
            unset($data['additional_fields']);
        }

        parent::hydrate($data, $order);

        return $order;
    }
}