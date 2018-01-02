<?php

namespace MembershipClient\Api;

use GuzzleHttp\Client;

class HttpClient
{

    public function __construct(
        Client $http
    ) {
        $this->http = $http;
    }

    public function get(
        string $url,
        array $query = []
    ) {
        $res = $this->http->request(
            "GET",
            $url,
            ['query' => $query]
        );
        return json_decode((string) $res->getBody(), true);
    }
}
