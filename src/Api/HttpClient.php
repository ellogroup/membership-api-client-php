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
        try {
            $res = $this->http->request("GET", $url, ['query' => $query]);
            return json_decode((string) $res->getBody(), true);
        } catch (\Exception $e) {
            $m = sprintf("failed request: %s", $e->getMessage());
            throw new \RuntimeException($m);
        }
    }

    public function post(
        string $url,
        string $body
    ) {
        try {
            $res = $this->http->request("POST", $url, ['body' => $body]);
            return json_decode((string) $res->getBody(), true);
        } catch (\Exception $e) {
            $m = sprintf("failed request: %s", $e->getMessage());
            throw new \RuntimeException($m);
        }
    }
}
