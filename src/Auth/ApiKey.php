<?php

namespace LegacyBeta\Tapfiliate\Auth;

class ApiKey implements AuthHeaderInterface
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getHeaders(): array
    {
        return [
            'Api-Key' => $this->apiKey
        ];
    }
}