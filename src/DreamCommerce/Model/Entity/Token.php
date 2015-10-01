<?php

namespace DreamCommerce\Model\Entity;

class Token extends ShopDependent implements TokenInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var int $tokenId
     */
    protected $tokenId;

    /**
     * @var \DateTime $createdAt
     */
    protected $creationDate;

    /**
     * @var \DateTime $expirationDate
     */
    protected $expirationDate;

    /**
     * @var string $accessToken
     */
    protected $accessToken;

    /**
     * @var string $refreshToken
     */
    protected $refreshToken;

    /**
     * @return int
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * @param int $tokenId
     * @return $this
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param \DateTime $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

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
}