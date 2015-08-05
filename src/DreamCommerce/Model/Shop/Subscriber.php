<?php

namespace DreamCommerce\Model\Shop;

class Subscriber extends ResourceDependent implements SubscriberInterface
{
    /**
     * @var int
     */
    protected $subscriberId;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var \DateTime
     */
    protected $dateadd;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var \ArrayAccess
     */
    protected $groups;

    public function __construct()
    {
        $this->groups = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    /**
     * @param int $subscriberId
     * @return $this
     */
    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateadd()
    {
        return $this->dateadd;
    }

    /**
     * @param \DateTime|string $dateadd
     * @return $this
     */
    public function setDateadd($dateadd)
    {
        if(is_string($dateadd)) {
            $dateadd = new \DateTime($dateadd);
        }

        $this->dateadd = $dateadd;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param SubscriberGroupInterface $group
     * @return $this
     */
    public function addGroup(SubscriberGroupInterface $group)
    {
        $this->groups[] = $group;
        return $this;
    }

    /**
     * @param \ArrayAccess $groups
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Subscriber';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->subscriberId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->subscriberId = $id;
        return $this;
    }
}