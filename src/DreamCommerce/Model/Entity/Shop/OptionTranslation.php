<?php

namespace DreamCommerce\Model\Entity\Shop;

use DreamCommerce\Model\Entity\ShopDependent;

class OptionTranslation extends ShopDependent implements OptionTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var OptionInterface
     */
    protected $option;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @return int
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return OptionInterface
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption($option)
    {
        $this->option = $option;
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
}