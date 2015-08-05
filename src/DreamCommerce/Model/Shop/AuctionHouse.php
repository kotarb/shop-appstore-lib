<?php

namespace DreamCommerce\Model\Shop;

class AuctionHouse extends ResourceDependent implements AuctionHouseInterface
{
    /**
     * @var int
     */
    protected $auctionHouseId;

    /**
     * @var string
     */
    protected $engine;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var \ArrayAccess
     */
    protected $auctions;

    public function __construct()
    {
        $this->auctions = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getAuctionHouseId()
    {
        return $this->auctionHouseId;
    }

    /**
     * @param int $auctionHouseId
     * @return $this
     */
    public function setAuctionHouseId($auctionHouseId)
    {
        $this->auctionHouseId = $auctionHouseId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param string $engine
     * @return $this
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
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
     * @return \ArrayAccess
     */
    public function getAuctions()
    {
        return $this->auctions;
    }

    /**
     * @param AuctionInterface $auction
     * @return $this
     */
    public function addAuction(AuctionInterface $auction)
    {
        $this->auctions[] = $auction;
        return $this;
    }

    /**
     * @param \ArrayAccess $auctions
     * @return $this
     */
    public function setAuctions($auctions)
    {
        $this->auctions = $auctions;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\AuctionHouse';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->auctionHouseId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->auctionHouseId = $id;
        return $this;
    }
}