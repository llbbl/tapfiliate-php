<?php

namespace LegacyBeta\Tapfiliate\Adapter;

use GuzzleHttp\Client;
use LegacyBeta\Tapfiliate\Auth\AuthHeaderInterface;
use Psr\Http\Message\ResponseInterface;

class Guzzle implements AdapterInterface
{
    private $client;

    public function __construct(AuthHeaderInterface $auth, string $baseUri = 'https://api.tapfiliate.com/1.6/')
    {
        $headers = $auth->getHeaders();

        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers' => $headers,
            'accept' => 'application/json'
        ]);
    }

    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('get', $uri, $data, $headers);
    }

    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('post', $uri, $data, $headers);
    }

    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('put', $uri, $data, $headers);
    }

    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('patch', $uri, $data, $headers);
    }

    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('delete', $uri, $data, $headers);
    }

    public function request(string $method, string $uri, array $data = [], array $headers = [])
    {
        $response = $this->client->$method($uri, [
            'headers' => $headers,
            ($method === 'get' ? 'query' : 'json') => $data,
        ]);

        return $response;
    }
}