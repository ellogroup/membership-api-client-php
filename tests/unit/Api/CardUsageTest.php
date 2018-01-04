<?php

namespace Api;

use PHPUnit\Framework\TestCase;
use MembershipClient\Api\CardUsage;
use MembershipClient\Model\CardUsageFactory;
use MembershipClient\Api\HttpClient;
use MembershipClient\Model\CardUsage as Usage;

class CardUsageTest extends TestCase
{
    public function setUp()
    {
        $factory = new CardUsageFactory();
        $this->http = $this->createMock(HttpClient::class);
        $this->SUT = new CardUsage($this->http, $factory);
    }

    public function testFetchAllCallsCorrectUrl()
    {
        $this->http->expects($this->once())
            ->method('get')
            ->with('/membership/1/cardUsage')
            ->willReturn([]);
        $this->SUT->setMembershipId(1);
        $this->SUT->fetch();
    }

    public function testFetchByIdCallsCorrectUrl()
    {
        $this->http->expects($this->once())
            ->method('get')
            ->with('/membership/1/cardUsage/2')
            ->willReturn([]);

        $this->SUT->setId(2);
        $this->SUT->setMembershipId(1);
        $this->SUT->fetch();
    }

    public function testCreatePassesDataToCorrectUrl()
    {
        $usage = new Usage(
            "",
            1,
            2,
            "web",
            "2017-01-28 11:33:15"
        );

        $this->http->expects($this->once())
            ->method('post')
            ->with('/membership/1/cardUsage', json_encode($usage))
            ->willReturn([]);

        $this->SUT->setMembershipId(1);
        $this->SUT->create($usage);
    }
}
