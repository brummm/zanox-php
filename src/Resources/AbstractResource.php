<?php

namespace Zanox\Resources;

use Zanox\Client;
use Zanox\Request;
use Zanox\Contracts\ResourceInterface;

abstract class AbstractResource implements ResourceInterface{

    const ZNX_DATETIME = 'Y-m-d';

    protected $_client;

    public function __construct( Client $client = null )
    {
        $this->_client = $client;
    }

    public function setClient(Client $client)
    {
        $this->_client = $client;
        return $this;
    }

    public function request($method, $uri, array $query = null)
    {
        if( $query )
        {
            $uri = $this->applyQuery($uri, $query);
        }

        $request    = $this->makeHttpRequest($method, $uri);
        
        return $this->_client->send($request);
    }

    protected function applyQuery( $uri, array $parameters )
    {
        $query = http_build_query($parameters, '', '&');

        if( strlen( $query ) > 0)
        {
            $uri .= '?' . $query;
        }

        return $uri;
    }

    protected function getFormattedDate( \DateTime $date )
    {
        return $date->format( self::ZNX_DATETIME );
    }

    private function makeHttpRequest($method,$uri)
    {
        return new Request( $method, $uri );
    }
}