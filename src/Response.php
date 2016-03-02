<?php

namespace Zanox;

use GuzzleHttp\Psr7\Response as HttpResponse;
use Zanox\Contracts\ResponseInterface;

class Response implements ResponseInterface{
    protected $httpResponse;

    public function __construct( HttpResponse $response )
    {
        $this->httpResponse = $response;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }
}