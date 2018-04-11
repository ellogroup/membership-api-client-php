<?php

namespace MembershipClient\Model;

class AddressFactory
{
    /**
     * @param array $address
     * @return Address
     */
    public function build(array $address)
    {
        return new Address(
            $address["id"],
            $address["title"],
            $address["firstName"],
            $address["lastName"],
            $address["companyName"],
            $address["addressLine1"],
            $address["addressLine2"],
            $address["town"],
            $address["district"],
            $address["postalCode"],
            $address["countryCode"]
        );
    }

    /**
     * @param array $addresses
     * @return array
     */
    public function buildFromList(array $addresses)
    {
        return array_map(function (array $address) {
            return $this->build($address);
        }, $addresses);
    }
}
