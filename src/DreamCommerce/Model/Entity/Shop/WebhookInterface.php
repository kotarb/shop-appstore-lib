<?php

namespace DreamCommerce\Model\Entity\Shop;

interface WebhookInterface extends ResourceDependentInterface
{
    /**
     * @return string
     */
    public function getSecret();
}