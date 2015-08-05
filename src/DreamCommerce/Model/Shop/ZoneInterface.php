<?php

namespace DreamCommerce\Model\Shop;

interface ZoneInterface extends ResourceDependentInterface
{
    const ZONE_MODE_COUNTRIES = 1;
    const ZONE_MODE_REGIONS = 2;
    const ZONE_MODE_CODES = 3;
}