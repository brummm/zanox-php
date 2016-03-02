<?php

namespace Zanox\Tests;

use Zanox\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;

class RequestTest extends \PHPUnit_Framework_TestCase{

    public function testSign()
    {
        $request = new Request( getenv('ZNX_TEST_METHOD'), getenv('ZNX_TEST_URI'));
        $validSignature ='ZXWS '.getenv('ZNX_TEST_CONNECTID').':N4RPYDY1aUjciVm32pCJ82FVvuk=';

        $signedRequest = $request->sign( 
            getenv('ZNX_TEST_CONNECTID'), 
            getenv('ZNX_TEST_SECRETKEY'), 
            getenv('ZNX_TEST_TIMESTAMP'), 
            getenv('ZNX_TEST_NONCE') 
        );

        $this->assertSame(getenv('ZNX_TEST_TIMESTAMP'), $signedRequest->getHeader('Date')[0]);
        $this->assertSame(getenv('ZNX_TEST_NONCE'), $signedRequest->getHeader('nonce')[0]);
        $this->assertSame($validSignature, $signedRequest->getHeader('Authorization')[0]);
    }
}