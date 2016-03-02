<?php
namespace Zanox;

use Zanox\Contracts\RequestInterface;
use GuzzleHttp\ClientInterface;

/**
 * Client interface for Zanox API.
 *
 * @link https://developer.zanox.com/web/guest/home
 */
class Client
{
    /**
     * @var ClientInterface
     */
    private $_httpClient;

     /**
     * Zanox connect ID
     * @var string
     */
    private $connectId = '';

    /**
     * Zanox shared secret key
     * @var string
     */
    private $secretKey = '';

    /**
     * If you provide any parameters if will instantiate a HTTP client on construction.
     * Otherwise it will create one when required.
     *
     * @param string $auth Zanox auth credentials.
     * @param string $host Zanox API host. Defaults to 'https://api.zanox.com/json'
     * @param string $version Zanox API version. Defaults to '2011-03-01'
     */
    public function __construct(array $auth = null, $host = null, $version = null)
    {
        // lazily instantiante
        if ($host || $version) 
        {
            $client = default_http_client($host, $version);
            $this->setHttpClient($client);
        }

        if($auth)
        {
            $this->setConnectId($auth['connectId'])->setSecretKey($auth['secretKey']);
        }
    }

    public function getHttpClient()
    {
        if (!$this->_httpClient) 
        {
            $this->_httpClient = default_http_client();
        }

        return $this->_httpClient;
    }

    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->_httpClient = $httpClient;
        return $this;
    }

    public function setConnectId($connectId)
    {
        $this->connectId = $connectId;
        return $this;
    }

    public function setSecretKey($secret)
    {
        $this->secretKey = $secret;
        return $this;
    }

    public function send(RequestInterface $request)
    {
        $signedRequest = $request->sign($this->connectId, $this->secretKey);
        $httpResponse  = $this->getHttpClient()->send($signedRequest);

        return new Response( $httpResponse );
    }
}
