<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\CardUsageFactory;
use MembershipClient\Model\CardUsage as Usage;

class CardUsageFactoryTest extends TestCase
{
    public function setUp()
    {
        $this->SUT = new CardUsageFactory();
    }

    public function testBuildReturnsUsage()
    {
        $usage = [
            'id' => 1,
            'membershipId' => 2,
            'restaurantId' => 3,
            'platform' => 'web',
            'usageTime' => ''
        ];
        $expected = new Usage(
            $usage['id'],
            $usage['membershipId'],
            $usage['restaurantId'],
            $usage['platform'],
            $usage['usageTime']
        );

        $result = $this->SUT->build($usage);

        $this->assertEquals($expected, $result);
    }
}
