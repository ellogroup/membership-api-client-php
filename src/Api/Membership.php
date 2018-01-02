<?php

namespace MembershipClient\Api;

use MembershipClient\Api\CardUsage;

class Membership
{
    private $cardUsage;
    private $id;

    public function __construct(
        CardUsage $cardUsage
    ) {
        $this->cardUsage = $cardUsage;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function cardUsage($id = null)
    {
        $this->cardUsage->setMembershipId($this->id);
        $this->cardUsage->setId($id);
        return $this->cardUsage;
    }
}
