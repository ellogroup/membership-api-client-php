<?php

use PHPUnit\Framework\TestCase;
use MembershipClient\Api\Membership;
use MembershipClient\Api\HttpClient;
use MembershipClient\Api\CardUsage;

class MembershipTest extends TestCase
{
    public function setUp()
    {
        $this->cardUsageApi = $this->createMock(CardUsage::class);
        $this->http = $this->createMock(HttpClient::class);
        $this->SUT = new Membership($this->http, $this->cardUsageApi);
    }

    public function testCancelSendsRequiredDataToPatch()
    {
        $this->SUT->setId("hashid");
        $dat = "2018-01-28 10:00:00";
        $cancellationDate = new \DateTimeImmutable($dat);
        $cancelledFrom = new \DateTimeImmutable($dat);

        $this->http->expects($this->once())
            ->method("patch")
            ->with(
                "/membership/hashid",
                '{"cancellationDate":"2018-01-28T10:00:00+0000","cancelledFrom":"2018-01-28T10:00:00+0000"}'
            );

        $this->SUT->cancel(
            $cancellationDate,
            $cancelledFrom
        );
    }

    public function testCancelSendsOptionalDataToPatch()
    {
        $this->SUT->setId("hashid");
        $dat = "2018-01-28 10:00:00";
        $cancellationDate = new \DateTimeImmutable($dat);
        $cancelledFrom = new \DateTimeImmutable($dat);

        $this->http->expects($this->once())
            ->method("patch")
            ->with(
                "/membership/hashid",
                '{"cancellationDate":"2018-01-28T10:00:00+0000","cancelledFrom":"2018-01-28T10:00:00+0000","cancellationReasonId":"reason_id","cancellationMethod":"cancel_method"}'
            );

        $this->SUT->cancel(
            $cancellationDate,
            $cancelledFrom,
            "reason_id",
            "cancel_method"
        );
    }
}
