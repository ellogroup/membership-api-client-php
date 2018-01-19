<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Model\CancellationReasonFactory;
use MembershipClient\Model\CancellationReason;

class CancellationReasonFactoryTest extends TestCase
{
    public function setUp()
    {
        $this->SUT = new CancellationReasonFactory();
    }

    public function testFromResponseReturnsListOfReasons()
    {
        $in = [
            [
                'id' => 1,
                'reason' => 'test',
                'children' => [
                    ['id' => 2, 'reason' => 'test2', 'children' => []]
                ]
            ]
        ];

        $expected = [
            new CancellationReason(1, 'test', [new CancellationReason(2, 'test2', [])])
        ];
        $result = $this->SUT->fromResponse($in);

        $this->assertEquals($expected, $result);
    }

    public function testBuildReturnsReason()
    {
        $reason = ['id' => 1, 'reason' => 'test'];
        $children = [];
        $result = $this->SUT->build($reason, $children);
        $expected = new CancellationReason(1, 'test', []);
        $this->assertEquals($expected, $result);
    }
}
