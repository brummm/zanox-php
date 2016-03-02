<?php

namespace Zanox\Tests\Resources;

use Zanox\Client;
use Zanox\Contracts\ResourceInterface;

abstract class ResourceTestCase extends \PHPUnit_Framework_TestCase{
    protected $resource;

    protected function getZanoxClient()
    {
        return new Client([
            'connectId' => getenv('ZNX_TEST_CONNECTID'),
            'secretKey' => getenv('ZNX_TEST_SECRETKEY'),
        ]);
    }

    protected function setResource( ResourceInterface $resource )
    {
        $this->resource = $resource;
    }
}