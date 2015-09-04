<?php

namespace DreamCommerce\Model\Entity;

use DreamCommerce\Model\Entity\Shop\WebhookInterface;

interface WebhookRequestInterface extends ShopDependentInterface
{
    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string
     */
    public function getShopVersion();

    /**
     * @return string
     */
    public function getShopDomain();

    /**
     * @return int
     */
    public function getWebhookId();

    /**
     * @return string
     */
    public function getWebhookName();

    /**
     * @return string
     */
    public function getWebhookSignature();

    /**
     * @return string
     */
    public function getData();

    /**
     * @return WebhookInterface
     */
    public function getWebhook();

    /**
     * @param WebhookInterface $webhook
     * @return $this
     */
    public function setWebhook(WebhookInterface $webhook);
}