<?php

namespace MembershipClient\Api;

use GuzzleHttp\Client;

class HttpClient
{
    public function __construct(
        Client $http,
        JwtToken $token
    ) {
        $this->http = $http;
        $this->token = $token;
    }

    public function get(
        string $url,
        array $query = []
    ) {
        try {
            $res = $this->http->request("GET", $url, ['headers' => $this->getDefaultHeaders(), 'query' => $query]);
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
            $res = $this->http->request("POST", $url, ['headers' => $this->getDefaultHeaders(), 'body' => $body]);
            return json_decode((string) $res->getBody(), true);
        } catch (\Exception $e) {
            $m = sprintf("failed request: %s", $e->getMessage());
            throw new \RuntimeException($m);
        }
    }

    private function getDefaultHeaders()
    {
        $token = $this->token->generate();
        return [
            'X-Consumer-Token' => $token
        ];
    }
}
