<?php

namespace DreamCommerce\Client;

use DreamCommerce\Client;
use DreamCommerce\Resource;
use DreamCommerce\Exception\ClientException;

/**
 * DreamCommerce requesting library
 *
 * @package DreamCommerce\Client
 */
class OAuth extends Bearer
{
    /**
     * OAuth ID
     * @var null|string
     */
    protected $clientId = null;

    /**
     * OAuth secret
     * @var null|string
     */
    protected $clientSecret = null;

    /**
     * Appstore secret
     *
     * @var null|string
     */
    protected $appstoreSecret = null;

    /**
     * OAuth code
     * @var null|string
     */
    protected $authCode = null;

    /**
     * Scopes
     * @var array
     */
    protected $scopes = array();

    /**
     * @param array $options
     * @throws \DreamCommerce\Exception\ClientException
     *
     * Example:
     * {
     *      application:        <ApplicationInterface>,
     *      shop:               <ShopInterface>,
     *      client_id:          'xxxxx',
     *      client_secret:      'xxxxx',
     *      appstore_secret:    'xxxxx',
     *      auth_code:          'xxxxx'
     * }
     */
    public function __construct($options = array())
    {
        if(!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array', ClientException::PARAMETER_NOT_SPECIFIED);
        }

        foreach(array('client_id', 'client_secret') as $reqParam) {
            if(!isset($options[$reqParam])) {
                throw new ClientException('Parameter "' . $reqParam . '" is required', ClientException::PARAMETER_NOT_SPECIFIED);
            }
        }

        $this->clientId = $options['client_id'];
        $this->clientSecret = $options['client_secret'];

        if(isset($options['auth_code'])) {
            $this->authCode = $options['auth_code'];
        }

        parent::__construct($options);
    }

    /**
     * Authentication
     *
     * @param boolean $force
     * @throws \DreamCommerce\Exception\ClientException
     * @return \stdClass
     * Example output:
     * {
     *      access_token:   'xxxxx',
     *      refresh_token:  'xxxxx',
     *      expires_in:     '3600',
     *      token_type:     'bearer',
     *      scope:          'products_read,orders_read'
     * }
     */
    public function authenticate($force = false)
    {
        $token = $this->shop->getToken();
        if($token->getAccessToken() !== null && !$force) {
            return false;
        }

        $res = $this->getHttpClient()->post(rtrim($this->shop->getUrl(), '/') . '/oauth/token', array(
            'code' => $this->getAuthCode()
        ), array(
            'grant_type' => 'authorization_code'
        ), array(
            'Authorization' => 'Basic ' . base64_encode($this->getClientId() . ':' . $this->getClientSecret())
        ));

        if(!$res || isset($res['data']['error'])){
            throw new ClientException($res['data']['error'], ClientException::API_ERROR);
        }

        $data = $res['data'];
        $token = $this->shop->getToken();
        $expirationDate = new \DateTime('+' . $data['expires_in'] . ' seconds');

        $token->setAccessToken($data['access_token'])
            ->setRefreshToken($data['refresh_token'])
            ->setExpirationDate($expirationDate);

        $this->scopes = explode(',', $data['scope']);

        return $data;
    }

    /**
     * Refresh OAuth tokens
     *
     * @return array
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function refreshTokens()
    {
        $token = $this->shop->getToken();

        $res = $this->getHttpClient()->post(rtrim($this->shop->getUrl()) . '/oauth/token', array(
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
            'refresh_token' => $token->getRefreshToken()
        ), array(
            'grant_type'=>'refresh_token'
        ));

        if(!$res || !empty($res['data']['error'])){
            throw new ClientException($res['error'], ClientException::API_ERROR);
        }

        $data = $res['data'];
        $expirationDate = new \DateTime('+' . $data['expires_in'] . ' seconds');

        $token->setAccessToken($data['access_token'])
            ->setRefreshToken($data['refresh_token'])
            ->setExpirationDate($expirationDate);

        $this->scopes = explode(',', $data['scope']);

        return $data;
    }

    /**
     * @return null|string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param null|string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param null|string $clientSecret
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAppstoreSecret()
    {
        return $this->appstoreSecret;
    }

    /**
     * @param null|string $appstoreSecret
     * @return $this
     */
    public function setAppstoreSecret($appstoreSecret)
    {
        $this->appstoreSecret = $appstoreSecret;
        return $this;
    }

    /**
     * @return string
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function getAuthCode()
    {
        if($this->authCode === null) {
            throw new ClientException('Parameter "auth_code" is required', ClientException::PARAMETER_NOT_SPECIFIED);
        }

        return $this->authCode;
    }

    /**
     * @param null|string $authCode
     * @return $this
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    public static function getAvailableScopeModules()
    {
        return array(
            'metafields',
            'dashboard',
            'auctions',
            'attributes',
            'availabilities',
            'categories',
            'currencies',
            'deliveries',
            'languages',
            'options',
            'orders',
            'parcels',
            'payments',
            'producers',
            'products',
            'shippings',
            'statuses',
            'subscribers',
            'taxes',
            'units',
            'users',
            'webhooks',
            'gauges',
            'aboutpages',
            'zones',
        );
    }

    public static function getAvailableScopePermissions()
    {
        return array(
            'read', 'create', 'edit', 'delete'
        );
    }
}