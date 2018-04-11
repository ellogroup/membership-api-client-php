<?php

namespace MembershipClient\Model;

class CustomerFactory
{
    /**
     * @var AddressFactory
     */
    private $addressFactory;

    /**
     * @var MembershipFactory
     */
    private $membershipFactory;

    /**
     * CustomerFactory constructor.
     *
     * @param AddressFactory $addressFactory
     * @param MembershipFactory $membershipFactory
     */
    public function __construct(
        AddressFactory $addressFactory,
        MembershipFactory $membershipFactory
    ) {
        $this->addressFactory = $addressFactory;
        $this->membershipFactory = $membershipFactory;
    }

    public function build(array $customer)
    {
        return new Customer(
            $customer['id'],
            $customer['title'],
            $customer['firstName'],
            $customer['lastName'],
            $customer['emailAddress'],
            $customer['phoneNumber'],
            $customer['mobilePhone'],
            $customer['consumerId'],
            $customer['consumerCustomerId'],
            $this->addressFactory->buildFromList($customer['addresses']),
            $this->membershipFactory->buildFromList($customer['memberships'])
        );
    }

    public function fromResponse(array $response)
    {
        $out = array_map(
            function ($customer) {
                return $this->build($customer);
            },
            $response
        );
        return $out;
    }
}
