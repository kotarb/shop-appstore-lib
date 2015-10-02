<?php

namespace DreamCommerce\Model;

use DreamCommerce\Exception\ModelException;
use DreamCommerce\Model\Entity\ShopDependentInterface;
use DreamCommerce\Model\Entity\ShopInterface;
use DreamCommerce\Model\Provider\ProviderInterface;
use DreamCommerce\Model\Provider\Skeleton as SkeletonProvider;
use DreamCommerce\Model\Provider\Rest as RestProvider;
use DreamCommerce\Model\Provider\Doctrine as DoctrineProvider;
use DreamCommerce\Model\Provider\Webhook as WebhookProvider;

class Manager implements ManagerInterface
{
    const PROVIDER_SKELETON = 'skeleton';
    const PROVIDER_WEBHOOK = 'webhook';
    const PROVIDER_REST = 'rest';
    const PROVIDER_DOCTRINE = 'doctrine';

    /**
     * @var \SplPriorityQueue
     */
    private $providers;

    /**
     * @var int
     */
    private $serial = PHP_INT_MAX;

    /**
     * {@inheritdoc}
     */
    public function find(ShopInterface $shop, $objectName, $objectId, $forceProvider = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function persist(ShopDependentInterface $object)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function flush(ShopDependentInterface $object = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function registerProvider($provider, $priority = 10)
    {
        if(is_string($provider)) {
            switch($provider) {
                case self::PROVIDER_SKELETON:
                    $provider = new SkeletonProvider();
                    break;
                case self::PROVIDER_REST:
                    $provider = new RestProvider();
                    break;
                case self::PROVIDER_DOCTRINE:
                    $provider = new DoctrineProvider();
                    break;
                case self::PROVIDER_WEBHOOK:
                    $provider = new WebhookProvider();
                    break;
            }
        }

        if(! $provider instanceof ProviderInterface) {
            throw new ModelException();
        }

        if (!is_array($priority)) {
            $priority = array($priority, $this->serial--);
        }

        $this->providers->insert($provider, $priority);
    }

    /**
     * {@inheritdoc}
     */
    public function getProviders()
    {
        if($this->providers === null) {
            $this->providers = new \SplPriorityQueue();
        }

        return $this->providers;
    }
}