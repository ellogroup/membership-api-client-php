<?php

namespace MembershipClient\Model;

class CardUsage
{
    private $id;
    private $membershipId;
    private $restaurantId;
    private $platform;
    private $usageTime;

    public function __construct(
        string $id,
        string $membershipId,
        string $restaurantId,
        string $platform,
        string $usageTime
    ) {
        $this->id = $id;
        $this->membershipId = $membershipId;
        $this->restaurantId = $restaurantId;
        $this->platform = $platform;
        $this->usageTime = $usageTime;
    }
}
