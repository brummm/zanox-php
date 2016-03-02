<?php 

namespace Zanox\Contracts;

use Psr\Http\Message\RequestInterface as HttpRequestInterface;

interface RequestInterface extends HttpRequestInterface{
    public function sign( $connectId, $secret, $timestamp = null, $nonce = null );
}