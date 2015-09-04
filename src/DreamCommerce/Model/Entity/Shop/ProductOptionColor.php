<?php

namespace DreamCommerce\Model\Entity\Shop;

class ProductOptionColor extends ProductOption
{
    /**
     * @var ProductImageInterface
     */
    protected $productImage;

    /**
     * @var OptionValueColorInterface
     */
    protected $optionValueColor;
}