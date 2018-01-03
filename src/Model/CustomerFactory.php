<?php

namespace MembershipClient\Model;

use MembershipClient\Model\Customer;

class CustomerFactory
{

    public function build(array $customer)
    {
        return new Customer(
            $customer['id'],
            $customer['title'],
            $customer['firstName'],
            $customer['lastName'],
            $customer['emailAddress'],
            $customer['phoneNumber'],
            $customer['mobilePhone']
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
