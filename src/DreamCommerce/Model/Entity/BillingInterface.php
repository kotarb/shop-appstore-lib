<?php

namespace DreamCommerce\Model\Entity;

interface BillingInterface extends ShopDependentInterface
{
    /**
     * @return ApplicationInterface
     */
    public function getApplication();

    /**
     * @param ApplicationInterface $application
     * @return $this
     */
    public function setApplication(ApplicationInterface $application);
}