<?php

namespace MembershipClient\Api;

use MembershipClient\Api\CardUsage;

class Membership
{
    private $cardUsageApi;
    private $id;

    public function __construct(
        HttpClient $http,
        CardUsage $cardUsageApi
    ) {
        $this->cardUsageApi = $cardUsageApi;
        $this->http = $http;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function cancel(
        \DateTimeImmutable $cancellationDate,
        \DateTimeImmutable $cancelledFrom,
        string $cancellationReasonId = null,
        string $cancellationMethod = null
    ) {
        $url = sprintf("/membership/%s", $this->id);
        $cancellation = [
            'cancellationDate' => $cancellationDate->format(\DateTime::ISO8601),
            'cancelledFrom' => $cancelledFrom->format(\DateTime::ISO8601),
        ];
        if (isset($cancellationReasonId)) {
            $cancellation['cancellationReasonId'] = $cancellationReasonId;
        }
        if (isset($cancellationMethod)) {
            $cancellation['cancellationMethod'] = $cancellationMethod;
        }
        $this->http->patch(
            $url,
            json_encode($cancellation)
        );
    }

    public function cardUsage(string $id = null)
    {
        $this->cardUsageApi->setMembershipId($this->id);
        $this->cardUsageApi->setId($id);
        return $this->cardUsageApi;
    }
}
