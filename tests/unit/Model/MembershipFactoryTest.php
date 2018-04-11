<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\MembershipFactory;
use MembershipClient\Model\Membership;

class MembershipFactoryTest extends TestCase
{
    /**
     * @var MembershipFactory
     */
    private $sut;

    public function setUp()
    {
        $this->sut = new MembershipFactory();
    }

    public function testBuild()
    {
        $membership = $this->sut->build($this->getTestData());
        $this->assertInstanceOf(Membership::class, $membership);
        $this->assertSame("n70zqPXBaxA9RdJ4", $membership->getId());
    }

    public function testBuildFromList()
    {
        $memberships = $this->sut->buildFromList([
            $this->getTestData(),
            $this->getTestData()
        ]);
        $this->assertCount(2, $memberships);
        $this->assertInstanceOf(Membership::class, $memberships[0]);
        $this->assertInstanceOf(Membership::class, $memberships[1]);
        $this->assertSame("n70zqPXBaxA9RdJ4", $memberships[0]->getId());
        $this->assertSame("n70zqPXBaxA9RdJ4", $memberships[1]->getId());
    }

    private function getTestData()
    {
        return [
            "id" => "n70zqPXBaxA9RdJ4",
            "status" => "Cancelled",
            "started" => "2018-02-15T17:07:49+00:00",
            "expires" => "2019-02-14T17:07:49+00:00",
            "type" => "B2C",
            "number" => "10000000",
            "cardNumber" => "10000000",
            "cardholderName" => null
        ];
    }
}
