<?php

namespace LegacyBeta\Tapfiliate\Tests\Endpoints;

use LegacyBeta\Tapfiliate\Tests\TestCase;

class CommissionsTest extends TestCase
{
    public function testListCommissions()
    {
        $adapter = $this->getFakeAdapter('get', 'Endpoints/Commissions/listCommissions.json');

        $adapter->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('commissions')
            );

        $commissions = new \LegacyBeta\Tapfiliate\Endpoints\Commissions($adapter);
        $result = $commissions->listCommissions();

        $this->assertEquals(2, count($result));
    }

    public function testGetCommission()
    {
        $adapter = $this->getFakeAdapter('get', 'Endpoints/Commissions/getCommission.json');

        $adapter->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('commissions/1027047/')
            );

        $commissions = new \LegacyBeta\Tapfiliate\Endpoints\Commissions($adapter);
        $result = $commissions->getCommission(1027047);

        $this->assertEquals(1027047, $result->id);
    }

    public function testUpdateCommission()
    {
        $adapter = $this->getFakeAdapter('patch', 'Endpoints/Commissions/updateCommission.json');

        $commissions = new \LegacyBeta\Tapfiliate\Endpoints\Commissions($adapter);
        $result = $commissions->updateCommission(1027047, 123, 'foobar');

        $this->assertEquals(1027047, $result->id);
        $this->assertEquals(123, $result->amount);
        $this->assertEquals('foobar', $result->comment);
    }

    public function testApproveCommission()
    {
        $adapter = $this->getFakeAdapter('put', 'Endpoints/Commissions/approveCommission.json');

        $adapter->expects($this->once())
            ->method('put')
            ->with(
                $this->equalTo('commissions/1027047/approved/')
            );

        $commissions = new \LegacyBeta\Tapfiliate\Endpoints\Commissions($adapter);
        $result = $commissions->approveCommission(1027047);

        $this->assertEquals(true, $result->approved);
    }

    public function testDisapproveCommission()
    {
        $adapter = $this->getFakeAdapter('delete', 'Endpoints/Commissions/disapproveCommission.json');

        $adapter->expects($this->once())
            ->method('delete')
            ->with(
                $this->equalTo('commissions/1027047/approved/')
            );

        $commissions = new \LegacyBeta\Tapfiliate\Endpoints\Commissions($adapter);
        $result = $commissions->disapproveCommission(1027047);

        $this->assertEquals(false, $result->approved);
    }
}