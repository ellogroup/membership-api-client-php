<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use MembershipClient\Client;

class ClientTest extends TestCase
{

    public function testItWorks()
    {
        // init, fetch endpoints
        $c = Client::init();

        $membershipId = "n70zqPXBaxA9RdJ4"; // 1
        $cardUsageId = "n70zqPXBaxA9RdJ4"; // 1
        $customerId = "n70zqPXBaxA9RdJ4"; // 1

        $res = $c->cancellationReasons()->fetch();
        $res = $c->membership($membershipId)->cardUsage()->fetch();
        $res = $c->membership($membershipId)->cardUsage($cardUsageId)->fetch();

        //$res = $c->membership($id)->cardUsage()->create($usage);

        $res = $c->customer()->fetch();
        $res = $c->customer($customerId)->fetch();

        //$res = $c->customer()->create();
        //$res = $c->customer($id)->update();
        //$res = $c->customer($id)->delete();
    }
}
