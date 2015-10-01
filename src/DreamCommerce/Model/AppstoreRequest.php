<?php

namespace DreamCommerce\Model;

use DreamCommerce\Model\Entity\ApplicationInterface;
use DreamCommerce\Model\Entity\ShopDependent;

class AppstoreRequest extends ShopDependent
{
    /**
     * @var int
     */
    protected $applicationVersion;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $translations;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $place;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @return ApplicationInterface
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param ApplicationInterface $application
     * @return $this
     */
    public function setApplication(ApplicationInterface $application)
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return int
     */
    public function getApplicationVersion()
    {
        return $this->applicationVersion;
    }

    /**
     * @param int $applicationVersion
     * @return $this
     */
    public function setApplicationVersion($applicationVersion)
    {
        $this->applicationVersion = $applicationVersion;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param string $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return $this
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }
}