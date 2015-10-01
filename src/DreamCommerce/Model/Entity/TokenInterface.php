<?php

namespace DreamCommerce\Model\Entity;

interface TokenInterface extends ShopDependentInterface
{
    /**
     * @return int
     */
    public function getTokenId();

    /**
     * @param int $tokenId
     * @return $this
     */
    public function setTokenId($tokenId);

    /**
     * @return \DateTime
     */
    public function getCreationDate();

    /**
     * @param \DateTime $creationDate
     * @return $this
     */
    public function setCreationDate($creationDate);

    /**
     * @return \DateTime
     */
    public function getExpirationDate();

    /**
     * @param \DateTime $expirationDate
     * @return $this
     */
    public function setExpirationDate($expirationDate);

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken);

    /**
     * @return string
     */
    public function getRefreshToken();

    /**
     * @param string $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken);
}