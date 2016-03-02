<?php

namespace Zanox\Contracts;

use GuzzleHttp\Psr7\Response;

interface ResponseInterface{
    public function __construct(Response $response);
    public function getHttpResponse();
}