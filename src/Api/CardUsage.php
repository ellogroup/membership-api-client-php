<?php

namespace MembershipClient\Api;

use MembershipClient\Model\CardUsage as Usage;

class CardUsage
{
    private $http;
    private $membershipId;
    private $id;

    public function __construct(
        HttpClient $http
    ) {
        $this->http = $http;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMembershipId($id)
    {
        $this->membershipId = $id;
    }

    public function fetch()
    {
        $url = sprintf("/membership/%s/cardUsage", $this->membershipId);
        if ($this->id) {
            $url = sprintf("%s/%s", $url, $this->id);
            $response = $this->http->get($url);
            return $this->factory($response);
        }
        $response = $this->http->get($url);
        $out = $this->formatResponse($response);
        return $out;
    }

    public function create(Usage $usage)
    {
        $url = sprintf("/membership/%s/cardUsage", $this->membershipId);
        $res = $this->http->post(
            $url,
            json_encode($usage)
        );
        return $this->factory($res);
    }

    private function formatResponse(array $response)
    {
        $out = array_map(
            function ($usage) {
                return $this->factory($usage);
            },
            $response
        );
        return $out;
    }

    private function factory(array $usage)
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
