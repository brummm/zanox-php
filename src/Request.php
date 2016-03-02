<?php

namespace Zanox;

use Zanox\Contracts\RequestInterface;
use GuzzleHttp\Psr7\Request as HttpRequest;

class Request extends HttpRequest implements RequestInterface{

    /**
     * Sign the request according to Zanox REST API Authentication
     *
     * @param  string $connectId Your Zanox connectId
     * @param  string $secret    Your Zanox secret key
     * @return void
     * @link https://developer.zanox.com/web/guest/authentication/zanox-oauth/oauth-rest
     */
    public function sign( $connectId, $secret, $timestamp = null, $nonce = null )
    {
        $time       = $timestamp ?: $this->assignTimestamp();
        $nonce      = $nonce ?: $this->assignNonce();
        $signature  = $this->getSignature( $time, $nonce, $secret );

        $request = $this->withHeader('Authorization',sprintf('ZXWS %s:%s',$connectId, $signature))
            ->withHeader('Date', $time)
            ->withHeader('nonce',$nonce);

        return $request;
    }

    /**
     * Returns a HMAC based signature
     * 
     * @param  string $timestamp Timestamp - in GMT, format "EEE, dd MMM yyyy HH:mm:ss"
     * @param  string $nonce     unique random string, generated at the time of request, valid once, 20 or more 
     * @param  string $secret    Your Zanox secret key
     * @return string            
     */
    private function getSignature( $timestamp, $nonce, $secret )
    {
        $sign = $this->getMethod() .'/'.strtolower( $this->getUri() ).$timestamp.$nonce;
        return $this->hmac( $sign, $secret );
    }

    private function hmac( $string, $secret )
    {
        $hmac = hash_hmac('sha1', utf8_encode($string), $secret);
        return $this->encodeBase64($hmac);
    }

    private function encodeBase64( $string )
    {
        $encode = '';

        for ($i=0; $i < strlen($string); $i+=2)
        {
            $encode .= chr(hexdec(substr($string, $i, 2)));
        }

        return base64_encode($encode);
    }

    private function assignTimestamp()
    {
        return gmdate('D, d M Y H:i:s T');
    }

    private function assignNonce()
    {
        return md5(microtime() . mt_rand());
    }
}