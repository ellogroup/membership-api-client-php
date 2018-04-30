<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use MembershipClient\Client;

/**
 * This file is intended to allow devs to test drive the client end to end
 * and serve as a usage example, it does not test anything other than wiring
 */
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
            "file://jwtRS256.key",
            1
        );

        $cancellationDate = new \DateTimeImmutable();
        $cancelledFrom = new \DateTimeImmutable();
        $cancellationReasonId = "n70zqPXBaxA9RdJ4";
        $cancellationMethod = "Phone";
        $c->membership($membershipId)->cancel(
            $cancellationDate,
            $cancelledFrom,
            $cancellationReasonId,
            $cancellationMethod
        );

        $res = $c->cancellationReasons()->fetch();
        $res = $c->membership($membershipId)->cardUsage()->create($usage);
        $res = $c->membership($membershipId)->cardUsage()->fetch();
        $res = $c->membership($membershipId)->cardUsage($cardUsageId)->fetch();
        $c->membership($membershipId)->cardUsage($cardUsageId)->delete();
        $res = $c->customer()->fetch();
        $res = $c->customer($customerId)->fetch();
        $c->customer($customerId)->delete();




        // NOT YET IMPLEMENTED
        //$res = $c->membership($membershipId)->cardUsage($cardUsageId)->update();
        //$res = $c->customer()->create();
        //$res = $c->customer($id)->update();
    }
}
