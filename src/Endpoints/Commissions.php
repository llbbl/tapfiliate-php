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

    public function listCommissions(): array
    {
        $response = $this->adapter->get($this->url);

        return json_decode($response->getBody());
    }

    public function getCommission(int $commissionId): object
    {
        $response =  $this->adapter->get($this->url . '/' . $commissionId . '/');

        return json_decode($response->getBody());
    }

    public function updateCommission(int $commissionId, float $amount, string $comment = null): object
    {
        $query = [
            'amount' => $amount
        ];

        if ($comment !== null) {
            $query['comment'] = $comment;
        }
        
        $response =  $this->adapter->patch($this->url . '/' . $commissionId . '/', $query);

        return json_decode($response->getBody());
    }

    public function approveCommission(int $commissionId): object
    {
        $response =  $this->adapter->put($this->url . '/' . $commissionId . '/approved/');

        return json_decode($response->getBody());
    }

    public function disapproveCommission(int $commissionId): object
    {
        $response =  $this->adapter->delete($this->url . '/' . $commissionId . '/approved/');

        return json_decode($response->getBody());
    }
}