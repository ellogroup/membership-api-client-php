<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\Customer;
use MembershipClient\Model\CustomerFactory;
use MembershipClient\Model\AddressFactory;
use MembershipClient\Model\MembershipFactory;

class CustomerFactoryTest extends TestCase
{
    /**
     * @var CustomerFactory
     */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new CustomerFactory(new AddressFactory(), new MembershipFactory());
    }

    public function testBuildReturnsCustomer()
    {
        $customer = [
            'id' => 1,
            'title' => 'mr',
            'firstName' => 'jay',
            'lastName' => 'Z',
            'emailAddress' => 'test@test.com',
            'phoneNumber' => 01234,
            'mobilePhone' => 01234,
            'consumerId' => 3,
            'consumerCustomerId' => 'abcdef',
            'addresses' => [],
            'memberships' => [],
        ];
        $expected = new Customer(
            $customer['id'],
            $customer['title'],
            $customer['firstName'],
            $customer['lastName'],
            $customer['emailAddress'],
            $customer['phoneNumber'],
            $customer['mobilePhone'],
            $customer['consumerId'],
            $customer['consumerCustomerId'],
            $customer['addresses'],
            $customer['memberships']
        );

        $result = $this->SUT->build($customer);

        $this->assertEquals($expected, $result);
    }
}
