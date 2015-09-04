<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependent;

abstract class UserAdditionalField extends ShopDependent implements UserAdditionalFieldInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var AdditionalFieldInterface
     */
    protected $additionalField;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField()
    {
        return $this->additionalField;
    }

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField)
    {
        $this->additionalField = $additionalField;
        return $this;
    }
}