<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependentInterface;

interface GaugeTranslationInterface extends LanguageDependentInterface, ShopDependentInterface
{
    /**
     * @return GaugeInterface
     */
    public function getGauge();

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function setGauge(GaugeInterface $gauge);
}