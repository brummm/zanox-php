<?php

namespace Zanox\Tests;

use Zanox\Client;

class ClientTest extends \PHPUnit_Framework_TestCase{

    public function testGetHttpClient()
    {
        $client = new Client();
        $this->assertInstanceOf('GuzzleHttp\ClientInterface', $client->getHttpClient());
    }

    public function testItWillSignRequest()
    {
        $auth = [
            'connectId' => getenv('ZNX_TEST_CONNECTID'),
            'secretKey' => getenv('ZNX_TEST_SECRETKEY'),
        ];

        $request = $this->getMockBuilder('\Zanox\Request')
                        ->setConstructorArgs($auth)
                        ->setMethods(['sign'])
                        ->getMock();

        $request->expects($this->once())->method('sign')->will($this->returnSelf());;

        (new Client($auth))->send($request);
    }
}