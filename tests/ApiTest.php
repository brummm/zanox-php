<?php

namespace Zanox\Tests;

use Zanox\Api;

class ApiTest extends \PHPUnit_Framework_TestCase{
    public function testGetClient()
    {
        $zanox = new Api();
        $this->assertInstanceOf('\Zanox\Client', $zanox->getClient());
    }

    public function testGetResourceNamespace()
    {
        $zanox = new Api();
        $this->assertSame('\Zanox\Resources\\', $zanox->getResourceNamespace());
    }

    public function testResource()
    {
        $zanox = new Api();
        $resourceClass = $zanox->getResourceNamespace().ucfirst(getenv('ZNX_TEST_RESOURCE'));

        $this->assertInstanceOf($resourceClass, $zanox->resource(getenv('ZNX_TEST_RESOURCE')));
    }
}