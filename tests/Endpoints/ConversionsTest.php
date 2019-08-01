<?php

namespace LegacyBeta\Tapfiliate\Tests\Endpoints;

use LegacyBeta\Tapfiliate\Tests\TestCase;

class ConversionsTest extends TestCase
{
    public function testListConversions()
    {
        $adapter = $this->getFakeAdapter('get', 'Endpoints/Conversions/listConversions.json');

        $adapter->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('conversions')
            );

        $conversions = new \LegacyBeta\Tapfiliate\Endpoints\Conversions($adapter);
        $result = $conversions->listConversions();

        $this->assertEquals(1, count($result));
    }

    public function testGetConversion()
    {
        $adapter = $this->getFakeAdapter('get', 'Endpoints/Conversions/getConversion.json');

        $adapter->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('conversions/2807860')
            );

        $conversions = new \LegacyBeta\Tapfiliate\Endpoints\Conversions($adapter);
        $result = $conversions->getConversion(2807860);

        $this->assertEquals(2807860, $result->id);
    }

    public function testUpdateConversions()
    {
        $adapter = $this->getFakeAdapter('patch', 'Endpoints/Conversions/updateConversion.json');

        $conversions = new \LegacyBeta\Tapfiliate\Endpoints\Conversions($adapter);
        $result = $conversions->updateConversions(2807860, 1.5, 'PAR453277X', ['foo' => 'bar']);

        $this->assertEquals(2807860, $result->id);
        $this->assertEquals(1.5, $result->amount);
        $this->assertEquals('bar', $result->meta_data->foo);
    }

    public function testAddCommissionToConversion()
    {
        $adapter = $this->getFakeAdapter('post', 'Endpoints/Conversions/addCommissionToConversion.json');

        $conversions = new \LegacyBeta\Tapfiliate\Endpoints\Conversions($adapter);
        $result = $conversions->addCommissionToConversion(2807860, 50.7, 'mycommissiontype', 'Awesome!');

        $this->assertEquals(4646819, $result[0]->id);
        $this->assertEquals(50.7, $result[0]->conversion_sub_amount);
        $this->assertEquals('Awesome!', $result[0]->comment);
    }
}