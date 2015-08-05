<?php

namespace DreamCommerce\Model;

class Token implements TokenInterface
{
    /**
     * @var int $accessTokenId
     */
    protected $accessTokenId;

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
     * @var \DreamCommerce\Model\ShopInterface $shop
     */
    protected $shop;

    /**
     * @return int
     */
    public function getAccessTokenId()
    {
        return $this->accessTokenId;
    }

    /**
     * @param int $accessTokenId
     * @return $this
     */
    public function setAccessTokenId($accessTokenId)
    {
        $this->accessTokenId = $accessTokenId;
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
     * @return mixed
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $this;
    }
}