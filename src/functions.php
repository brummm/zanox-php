<?php

namespace Zanox;

use GuzzleHttp\Client as GuzzleClient;

const DEFAULT_HOST      = 'https://api.zanox.com/json';
const DEFAULT_VERSION   = '2011-03-01';

/**
 * Creates a pre-configured Guzzle Client with the default settings.
 *
 * @param string $host    Zanox API host. Defaults to 'https://api.zanox.com/json'
 * @param string $version Zanox API version. Defaults to '2011-03-01'
 *
 * @return \GuzzleHttp\Client
 */
function default_http_client($host = null, $version = null)
{
    $config = default_http_config($host, $version);
    return new GuzzleClient($config);
}

/**
 * Form default configuration settings for Guzzle Client.
 *
 * @param string $host    Zanox API host. Defaults to 'https://api.zanox.com/json'
 * @param string $version Zanox API version. Defaults to '2011-03-01'
 *
 * @return array
 */
function default_http_config($host = null, $version = null)
{
    $base_uri = $host ? trim($host, '/') : DEFAULT_HOST;
    $base_uri .= '/'.($version ? trim($version, '/') : DEFAULT_VERSION).'/';

    return [
        'base_uri' => $base_uri,
        'headers' => [
            'Content-Type'  => 'application/json',
            'User-Agent'    => 'zxPhp ApiClient',
        ],
        'http_errors' => false,
    ];
}