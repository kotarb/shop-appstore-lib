<?php

namespace DreamCommerce\Model\Shop;

interface PaymentTranslationInterface extends TranslationInterface, BaseInterface
{
    /**
     * @return PaymentInterface
     */
    public function getPayment();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function setPayment(PaymentInterface $payment);
}