<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\CancellationReasonFactory;
use MembershipClient\Api\CancellationReasons;
use MembershipClient\Api\HttpClient;

class CancellationReasonsTest extends TestCase
{
    public function testItCallsHttpClient()
    {
        $q = ['active' => 1, 'internal' => 1];
        $http = $this->createMock(HttpClient::class);
        $factory = $this->createMock(CancellationReasonFactory::class);
        $http->expects($this->once())
            ->method('get')
            ->with('/cancellation-reason', $q)
            ->willReturn([]);
        $SUT = new CancellationReasons($http, $factory);

        $SUT->fetch($q);
    }
}
