<?php

namespace LegacyBeta\Tapfiliate\Adapter;

use LegacyBeta\Tapfiliate\Auth\AuthHeaderInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterInterface
{
    public function __construct(AuthHeaderInterface $auth, string $baseURI);

    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface;

    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface;

    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface;

    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface;

    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface;
}