<?php

namespace MembershipClient\Model;

class MembershipFactory
{
    /**
     * @param array $membership
     * @return Membership
     */
    public function build(array $membership)
    {
        return new Membership(
            $membership["id"],
            $membership["status"],
            new \DateTimeImmutable($membership["started"]),
            new \DateTimeImmutable($membership["expires"]),
            $membership["type"],
            $membership["number"],
            $membership["cardNumber"],
            $membership["cardholderName"]
        );
    }

    /**
     * @param array $memberships
     * @return array
     */
    public function buildFromList(array $memberships)
    {
        return array_map(function (array $memberships) {
            return $this->build($memberships);
        }, $memberships);
    }
}
