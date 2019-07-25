<?php

namespace LegacyBeta\Tapfiliate\Endpoints;

use LegacyBeta\Tapfiliate\Adapter\AdapterInterface;

interface EndpointInterface
{
    public function __construct(AdapterInterface $adapter);
}