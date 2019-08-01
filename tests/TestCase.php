<?php

namespace LegacyBeta\Tapfiliate\Tests;

use GuzzleHttp\Psr7;
use LegacyBeta\Tapfiliate\Adapter\AdapterInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function getPsr7StreamForFixture(string $fixture): Psr7\Stream
    {
        $path = sprintf('%s/Fixtures/%s', __DIR__, $fixture);

        $this->assertFileExists($path);

        $stream = Psr7\stream_for(file_get_contents($path));

        $this->assertInstanceOf(Psr7\Stream::class, $stream);

        return $stream;
    }

    protected function getPsr7JsonResponseForFixture(string $fixture, int $statusCode = 200): Psr7\Response
    {
        $stream = $this->getPsr7StreamForFixture($fixture);

        $this->assertNotNull(json_decode($stream));
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());

        return new Psr7\Response($statusCode, ['Content-Type' => 'application/json'], $stream);
    }

    protected function getFakeAdapter(string $method, string $fixture): AdapterInterface
    {
        $this->assertContains($method, ['get', 'delete', 'head', 'options', 'patch', 'post', 'put']);

        $response = $this->getPsr7JsonResponseForFixture($fixture);

        $mock = $this->getMockBuilder(AdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mock->method($method)->willReturn($response);

        return $mock;
    }
}