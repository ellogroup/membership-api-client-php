<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Api\Customer;
use MembershipClient\Api\HttpClient;
use MembershipClient\Model\CustomerFactory;

class CustomerTest extends TestCase
{
    public function setUp()
    {
        $factory = $this->createMock(CustomerFactory::class);
        $this->http = $this->createMock(HttpClient::class);
        $this->SUT = new Customer($this->http, $factory);
    }

    public function testFetchByIdCallsCorrectUrl()
    {
        $this->http->expects($this->once())
            ->method('get')
            ->with('/customer')
            ->willReturn([]);

        $this->SUT->fetch();
    }

    public function testFetchAllCallsCorrectUrl()
    {
        $this->http->expects($this->once())
            ->method('get')
            ->with('/customer/1')
            ->willReturn([]);

        $this->SUT->setId(1);
        $this->SUT->fetch();
    }
}
