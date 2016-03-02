<?php

namespace Zanox\Tests;

use Zanox\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;

class RequestTest extends \PHPUnit_Framework_TestCase{

    public function testSign()
    {
        $connectId = '802B8BF4AE99EBE00F41';
        $secretKey = 'fa4c0c2020Aa4c+ab9Ea0ec8d39E06/df2c5aa44';
        $timestamp = 'Thu, 15 Aug 2013 15:56:07 GMT';
        $nonce     = '17811FEFBA7448CE848327F835729AA2';

        $request = new Request( 'GET', 'reports/sales/date/2013-07-20');
        $validSignature ='ZXWS '.$connectId.':N4RPYDY1aUjciVm32pCJ82FVvuk=';

        $signedRequest = $request->sign( $connectId, $secretKey, $timestamp, $nonce );

        $this->assertSame($timestamp, $signedRequest->getHeader('Date')[0]);
        $this->assertSame($nonce, $signedRequest->getHeader('nonce')[0]);
        $this->assertSame($validSignature, $signedRequest->getHeader('Authorization')[0]);
    }
}