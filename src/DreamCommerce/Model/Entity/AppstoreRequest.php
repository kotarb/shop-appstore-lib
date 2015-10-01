<?php

namespace DreamCommerce\Model\Entity;

use DreamCommerce\Model\Entity\Shop\WebhookInterface;

class AppstoreRequest extends ShopDependent
{
    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $shopVersion;

    /**
     * @var string
     */
    protected $shopDomain;

    /**
     * @var integer
     */
    protected $webhookId;

    /**
     * @var string
     */
    protected $webhookName;

    /**
     * @var string
     */
    protected $webhookSignature;

    /**
     * @var string
     */
    protected $shopLicense;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var WebhookInterface
     */
    protected $webhook;

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @return $this
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopVersion()
    {
        return $this->shopVersion;
    }

    /**
     * @param string $shopVersion
     * @return $this
     */
    public function setShopVersion($shopVersion)
    {
        $this->shopVersion = $shopVersion;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopDomain()
    {
        return $this->shopDomain;
    }

    /**
     * @param string $shopDomain
     * @return $this
     */
    public function setShopDomain($shopDomain)
    {
        $this->shopDomain = $shopDomain;
        return $this;
    }

    /**
     * @return int
     */
    public function getWebhookId()
    {
        return $this->webhookId;
    }

    /**
     * @param int $webhookId
     * @return $this
     */
    public function setWebhookId($webhookId)
    {
        $this->webhookId = $webhookId;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebhookName()
    {
        return $this->webhookName;
    }

    /**
     * @param string $webhookName
     * @return $this
     */
    public function setWebhookName($webhookName)
    {
        $this->webhookName = $webhookName;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebhookSignature()
    {
        return $this->webhookSignature;
    }

    /**
     * @param string $webhookSignature
     * @return $this
     */
    public function setWebhookSignature($webhookSignature)
    {
        $this->webhookSignature = $webhookSignature;
        return $this;
    }

    /**
     * @return string
     */
    public function getShopLicense()
    {
        return $this->shopLicense;
    }

    /**
     * @param string $shopLicense
     * @return $this
     */
    public function setShopLicense($shopLicense)
    {
        $this->shopLicense = $shopLicense;
        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return WebhookInterface
     */
    public function getWebhook()
    {
        return $this->webhook;
    }

    /**
     * @param WebhookInterface $webhook
     * @return $this
     */
    public function setWebhook(WebhookInterface $webhook)
    {
        $this->webhook = $webhook;
        return $this;
    }
}