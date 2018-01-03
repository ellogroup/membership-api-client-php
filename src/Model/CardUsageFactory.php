<?php

namespace MembershipClient\Model;

use MembershipClient\Model\CardUsage as Usage;

class CardUsageFactory
{
    public function fromResponse(array $response)
    {
        $out = array_map(
            function ($usage) {
                return $this->build($usage);
            },
            $response
        );
        return $out;
    }

    public function build(array $usage)
    {
        $usage['id'] = $usage['id'] ?? "";
        $usage['membershipId'] = $usage['membershipId'] ?? "";
        $usage['restaurantId'] = $usage['restaurantId'] ?? "";
        $usage['platform'] = $usage['platform'] ?? "";
        $usage['usageTime'] = $usage['usageTime'] ?? "";
        return new Usage(
            $usage['id'],
            $usage['membershipId'],
            $usage['restaurantId'],
            $usage['platform'],
            $usage['usageTime']
        );
    }
}
