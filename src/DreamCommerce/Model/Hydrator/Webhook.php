<?php

namespace DreamCommerce\Model\Hydrator;

use DreamCommerce\Model\Manager as ModelManager;

class Webhook extends Base
{
    /**
     * @var ModelManager
     */
    protected $manager;

    public function __construct(ModelManager $manager)
    {
        $this->manager = $manager;
    }
}