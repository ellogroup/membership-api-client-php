<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\AddressFactory;
use MembershipClient\Model\Address;

class AddressFactoryTest extends TestCase
{
    /**
     * @var AddressFactory
     */
    private $sut;

    public function setUp()
    {
        $this->sut = new AddressFactory();
    }

    public function testBuild()
    {
        $address = $this->sut->build($this->getTestData());
        $this->assertInstanceOf(Address::class, $address);
        $this->assertSame("Chicken street", $address->getAddressLine1());
    }

    public function testBuildFromList()
    {
        $addresses = $this->sut->buildFromList([
            $this->getTestData(),
            $this->getTestData()
        ]);
        $this->assertCount(2, $addresses);
        $this->assertInstanceOf(Address::class, $addresses[0]);
        $this->assertInstanceOf(Address::class, $addresses[1]);
        $this->assertSame("Chicken street", $addresses[0]->getAddressLine1());
        $this->assertSame("Chicken street", $addresses[1]->getAddressLine1());
    }

    private function getTestData()
    {
        return [
            "id" => "0q5noEY9kpE8WZyL",
            "title" => null,
            "firstName" => "Jay",
            "lastName" => "Robinson",
            "companyName" => "",
            "addressLine1" => "Chicken street",
            "addressLine2" => "",
            "town" => "Leeds",
            "district" => "Yorkshire",
            "postalCode" => null,
            "countryCode" => "UK"
        ];
    }
}
