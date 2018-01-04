<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use MembershipClient\Client;

class ClientTest extends TestCase
{
    public function testItWorks()
    {
        $membershipId = "n70zqPXBaxA9RdJ4"; // 1
        $cardUsageId = "n70zqPXBaxA9RdJ4"; // 1
        $customerId = "n70zqPXBaxA9RdJ4"; // 1
        $restaurantId = "OYljzwxDeRXBNqe8"; // 910

        $usage = new \MembershipClient\Model\CardUsage(
            "",
            $membershipId,
            $restaurantId,
            "web",
            "2017-01-28 11:33:15"
        );

        $c = Client::init(
            "https://membership.dcg.local",
            "file://jwtRS256.key"
        );

        $res = $c->cancellationReasons()->fetch();
        $res = $c->membership($membershipId)->cardUsage()->fetch();
        $res = $c->membership($membershipId)->cardUsage($cardUsageId)->fetch();
        $res = $c->membership($membershipId)->cardUsage()->create($usage);

        $res = $c->customer()->fetch();
        $res = $c->customer($customerId)->fetch();

        //$res = $c->membership($membershipId)->cardUsage($cardUsageId)->update();
        //$res = $c->customer()->create();
        //$res = $c->customer($id)->update();
        //$res = $c->customer($id)->delete();
    }
}
