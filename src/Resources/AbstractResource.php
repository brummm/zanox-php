<?php

namespace Zanox\Resources;

use Zanox\Client;
use Zanox\Request;
use Zanox\Response;
use Zanox\Contracts\ResourceInterface;

abstract class AbstractResource implements ResourceInterface{

    const ZNX_DATETIME = 'YYYY-mm-dd';

    protected $_client;

    public function setClient(Client $client)
    {
        $this->_client = $client;
        return $this;
    }

    public function request($method, $uri, array $query = null)
    {
        $request    = $this->makeHttpRequest($method, $this->applyQuery($uri, $query));
        $response   = $this->_client->send($request);

        return new Response( $response );
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