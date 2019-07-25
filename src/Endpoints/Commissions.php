<?php

namespace LegacyBeta\Tapfiliate\Endpoints;

use LegacyBeta\Tapfiliate\Adapter\AdapterInterface;

class Commissions implements EndpointInterface
{
    protected $adapter;
    protected $url = 'commissions';
    
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function listCommissions()
    {
        $response = $this->adapter->get($this->url);

        return json_decode($response->getBody());
    }
}