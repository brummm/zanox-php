<?php

namespace Zanox;

use GuzzleHttp\Psr7\Response as HttpResponse;
use Zanox\Contracts\ResponseInterface;

class Response implements ResponseInterface{
    protected $httpResponse;
    protected $body;

    public function __construct( HttpResponse $response )
    {
        $this->httpResponse = $response;
        $this->body = json_decode($response->getBody()->getContents(),true);
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function hasError()
    {
        return $this->httpResponse->getStatusCode() !== 200;
    }

    public function errors()
    {
        return $this->hasError() ? $this->getBody() : null;
    }

    public function getBody()
    {
        return $this->body;
    }
}