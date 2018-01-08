<?php

namespace MembershipClient\Api;

use MembershipClient\Api\CardUsage;

class Membership
{
    private $cardUsageApi;
    private $id;

    public function __construct(
        CardUsage $cardUsageApi
    ) {
        $this->cardUsageApi = $cardUsageApi;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function cardUsage(string $id = null)
    {
        $this->cardUsageApi->setMembershipId($this->id);
        $this->cardUsageApi->setId($id);
        return $this->cardUsageApi;
    }
}
