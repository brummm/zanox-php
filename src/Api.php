<?php

namespace Zanox;

class Api {

    protected $client;

    protected $resources = [];

    protected $resourcesNamespace;

    public function __construct(array $auth = null, $host = null, $version = null)
    {
        $this->client = new Client( $auth, $host, $version );
        $this->resourcesNamespace = '\Zanox\Resources\\';
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient( Client $client )
    {
        $this->client = $client;
        return $this;
    }

    public function getResourceNamespace()
    {
        return $this->resourcesNamespace;
    }
    
    public function setResourceNamespace( $namespace )
    {
        $this->resourcesNamespace = $namespace;
        return $this;
    }

    public function resource($name)
    {
        if( !array_key_exists($name, $this->resources) )
        {
            $className = '\Zanox\Resources\\'.ucfirst($name);
            $this->resources[$name] = new $className;

            $this->resources[$name]->setClient($this->client);
        }

        return $this->resources[ $name ];
    }
}