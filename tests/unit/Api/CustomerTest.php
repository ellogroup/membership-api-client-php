<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Api\Customer;
use MembershipClient\Api\HttpClient;
use MembershipClient\Model\CustomerFactory;

class CustomerTest extends TestCase
{
    /**
     * @var Customer
     */
    private $SUT;

    /**
     * @var HttpClient|PHPUnit_Framework_MockObject_MockObject
     */
    private $http;

    public function setUp()
    {
        /** @var CustomerFactory|PHPUnit_Framework_MockObject_MockObject $factory */
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

    public function testDeleteCallsCorrectUrl()
    {
        $this->http->expects($this->once())
            ->method('delete')
            ->with('/customer/1');

        $this->SUT->setId(1);
        $this->SUT->delete();
    }
}
