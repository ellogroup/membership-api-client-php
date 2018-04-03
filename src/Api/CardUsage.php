<?php

namespace MembershipClient\Api;

use MembershipClient\Model\CardUsageFactory;
use MembershipClient\Model\CardUsage as Usage;

class CardUsage
{
    private $http;
    private $factory;
    private $membershipId;
    private $id;

    public function __construct(
        HttpClient $http,
        CardUsageFactory $factory
    ) {
        $this->http = $http;
        $this->factory = $factory;
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
            return $this->factory->build($response);
        }
        $response = $this->http->get($url);
        $out = $this->factory->fromResponse($response);
        return $out;
    }

    public function create(Usage $usage)
    {
        $url = sprintf("/membership/%s/cardUsage", $this->membershipId);
        $res = $this->http->post(
            $url,
            json_encode($usage)
        );
        return $this->factory->build($res);
    }

    public function delete()
    {
        $url = sprintf("/membership/%s/cardUsage/%s", $this->membershipId, $this->id);
        $this->http->delete($url);
    }
}
