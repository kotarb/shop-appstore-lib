<?php

namespace DreamCommerce\Model\Shop;

interface AvailabilityTranslationInterface extends TranslationInterface, BaseInterface
{
    /**
     * @return AvailabilityInterface
     */
    public function getAvailability();

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability);
}