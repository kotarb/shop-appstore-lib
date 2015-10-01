<?php

namespace DreamCommerce\Model\Hydrator\Webhook;

use DreamCommerce\Exception;
use DreamCommerce\Model\Hydrator\Webhook as WebhookHydrator;
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

class Order extends WebhookHydrator
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
            $user = $this->manager->find($shop, 'user', $data['user_id']);
            $order->setUser($user);
        }

        if(isset($data['currency_id'])) {
            /** @var CurrencyInterface $currency */
            $currency = $this->manager->find($shop, 'currency', $data['currency_id']);
            $order->setCurrency($currency);
        }

        if(isset($data['lang_id'])) {
            /** @var LanguageInterface $language */
            $language = $this->manager->find($shop, 'language', $data['lang_id']);
            $order->setLanguage($language);
        }

        if(isset($data['code_id'])) {
            /** @var PromoCodeInterface $promoCode */
            $promoCode = $this->manager->find($shop, 'promoCode', $data['code_id']);
            $order->setPromoCode($promoCode);
        }

        if(isset($data['billingAddress'])) {
            if(isset($data['billingAddress']['tax_id'])) {
                $data['billingAddress']['tax_identification_number'] = $data['billingAddress']['tax_id'];
            }
            /** @var OrderAddressInterface $billingAddress */
            $billingAddress = $this->manager->find($shop, 'orderBillingAddress', $data['billingAddress']['address_id'], true, ModelManager::PROVIDER_WEBHOOK);
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
            $deliveryAddress = $this->manager->find($shop, 'orderDeliveryAddress', $data['deliveryAddress']['address_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $deliveryAddress->setOrder($order);
            $this->fillModel($data['deliveryAddress'], $deliveryAddress);
            $order->setDeliveryAddress($deliveryAddress);
            unset($data['deliveryAddress']);
        }

        if(isset($data['auction'])) {
            /** @var AuctionOrderInterface $auctionOrder */
            $auctionOrder = $this->manager->find($shop, 'auctionOrder', $data['auction']['auction_order_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $auctionOrder->setOrder($order);
            $this->fillModel($data['auction'], $auctionOrder);
            $order->setAuctionOrder($auctionOrder);

            /** @var AuctionInterface $auction */
            $auction = $this->manager->find($shop, 'auction', $data['auction']['auction_id']);
            $auctionOrder->setAuction($auction);
            unset($data['auction']);
        }

        if(isset($data['shipping'])) {
            /** @var ShippingInterface $shipping */
            $shipping = $this->manager->find($shop, 'shipping', $data['shipping_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['shipping'], $shipping);

            if(isset($data['shipping']['tax_id'])) {
                /** @var TaxInterface $tax */
                $tax = $this->manager->find($shop, 'tax', $data['shipping']['tax_id']);
                $shipping->setTax($tax);
            }
            $order->setShipping($shipping);
            unset($data['shipping']);
        }

        if(isset($data['status'])) {
            /** @var StatusInterface $status */
            $status = $this->manager->find($shop, 'status', $data['status_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['status'], $status);
            $order->setStatus($status);

            /** @var StatusTranslationInterface $statusTranslation */
            $statusTranslation = $this->manager->find($shop, 'statusTranslation', null, false, ModelManager::PROVIDER_WEBHOOK);
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
            $payment = $this->manager->find($shop, 'payment', $data['payment_id'], true, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel($data['payment'], $payment);
            $order->setPayment($payment);

            /** @var PaymentTranslationInterface $paymentTranslation */
            $paymentTranslation = $this->manager->find($shop, 'paymentTranslation', null, false, ModelManager::PROVIDER_WEBHOOK);
            $this->fillModel(array(
                'lang_id' => $data['lang_id'],
                'payment_id' => $data['payment']['payment_id'],
                'title' => $data['payment']['title'],
                'description' => $data['payment']
            ), $paymentTranslation);

            /** @var LanguageInterface $language */
            $language = $this->manager->find($shop, 'language', $data['lang_id']);
            $paymentTranslation->setLanguage($language);
            $paymentTranslation->setPayment($payment);
            $payment->addTranslation($paymentTranslation);

            unset($data['payment']);
        }

        if(isset($data['products'])) {
            foreach($data['products'] as $productData) {
                /** @var OrderProductInterface $orderProduct */
                $orderProduct = $this->manager->find($shop, 'orderProduct', $productData['id'], false, ModelManager::PROVIDER_WEBHOOK);
                $orderProduct->setOrder($order);

                /** @var ProductInterface $product */
                $product = $this->manager->find($shop, 'product', $productData['product_id']);
                $orderProduct->setProduct($product);

                /** @var ProductStockInterface $productStock */
                $productStock = $this->manager->find($shop, 'productStock', $productData['stock_id']);
                $orderProduct->setProductStock($productStock);

                $this->fillModel($productData, $orderProduct);
                $order->addProduct($orderProduct);
            }
            unset($data['products']);
        }

        if(isset($data['additional_fields'])) {
            foreach($data['additional_fields'] as $additionalData) {
                /** @var OrderAdditionalFieldInterface $additionalField */
                $additionalField = $this->manager->find($shop, 'orderAdditionalField', $additionalData['field_id'], true, ModelManager::PROVIDER_WEBHOOK);
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