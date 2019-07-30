<?php

namespace LegacyBeta\Tapfiliate\Endpoints;

use LegacyBeta\Tapfiliate\Adapter\AdapterInterface;

class Conversions implements EndpointInterface
{
    protected $adapter;
    protected $url = 'conversions';
    
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function listConversions(): array
    {
        $response = $this->adapter->get($this->url);

        return json_decode($response->getBody());
    }

    public function getConversion(int $conversionId): object
    {
        $response =  $this->adapter->get($this->url . '/' . $conversionId);

        return json_decode($response->getBody());
    }

    public function updateConversions(int $conversionId, float $amount = null, string $externalId = null, array $metaData = null): object
    {
        $query = [];

        if ($amount !== null) {
            $query['amount'] = $amount;
        }
        if ($externalId !== null) {
            $query['external_id'] = $externalId;
        }
        if ($metaData !== null) {
            $query['meta_data'] = $metaData;
        }

        $response =  $this->adapter->patch($this->url . '/' . $conversionId . '/', $query);

        return json_decode($response->getBody());
    }

    public function deleteConversion(int $conversionId)
    {
        $response =  $this->adapter->delete($this->url . '/' . $conversionId . '/');

        return json_decode($response->getBody());
    }

    public function addCommissionToConversion(int $conversionId, float $conversionSubAmount, string $commissionType = null, string $comment = null): array
    {
        $query = [
            'conversion_sub_amount' => $conversionSubAmount
        ];

        if ($commissionType !== null) {
            $query['commission_type'] = $commissionType;
        }
        if ($comment !== null) {
            $query['comment'] = $comment;
        }

        $response =  $this->adapter->post($this->url . '/' . $conversionId . '/' . 'commissions/', $query);

        return json_decode($response->getBody());
    }

    public function getConversionMetaData(int $conversionId): object
    {
        $response =  $this->adapter->get($this->url . '/' . $conversionId . '/meta-data/');

        return json_decode($response->getBody());
    }

}
