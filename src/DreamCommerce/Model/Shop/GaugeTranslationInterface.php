<?php

namespace DreamCommerce\Model\Shop;

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