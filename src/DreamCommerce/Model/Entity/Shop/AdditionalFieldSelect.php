<?php

namespace DreamCommerce\Model\Entity\Shop;

class AdditionalFieldSelect extends AdditionalField
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}