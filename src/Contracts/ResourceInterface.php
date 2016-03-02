<?php 

namespace Zanox\Contracts;

use Zanox\Client;

interface ResourceInterface{
    public function setClient( Client $client );
    public function request( $method, $uri, array $query = null );
}