<?php

namespace MembershipClient\Api;

use GuzzleHttp\Client;

class HttpClient
{
    /**
     * @var Client
     */
    private $http;

    /**
     * @var JwtToken
     */
    private $token;

    /**
     * HttpClient constructor.
     *
     * @param Client $http
     * @param JwtToken $token
     */
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
            return \GuzzleHttp\json_decode((string) $res->getBody(), true);
        } catch (\InvalidArgumentException $e) {
            $m = sprintf("failed to decode json response: %s, %s", (string) $res->getBody(), $e->getMessage());
            throw new \InvalidArgumentException($m);
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
            return \GuzzleHttp\json_decode((string) $res->getBody(), true);
        } catch (\InvalidArgumentException $e) {
            $m = sprintf("failed to decode json response: %s, %s", (string) $res->getBody(), $e->getMessage());
            throw new \InvalidArgumentException($m);
        } catch (\Exception $e) {
            $m = sprintf("failed request: %s", $e->getMessage());
            throw new \RuntimeException($m);
        }
    }

    public function patch(
        string $url,
        string $body
    ) {
        try {
            $res = $this->http->request("PATCH", $url, ['headers' => $this->getDefaultHeaders(), 'body' => $body]);
            return \GuzzleHttp\json_decode((string) $res->getBody(), true);
        } catch (\InvalidArgumentException $e) {
            $m = sprintf("failed to decode json response: %s, %s", (string) $res->getBody(), $e->getMessage());
            throw new \InvalidArgumentException($m);
        } catch (\Exception $e) {
            $m = sprintf("failed request: %s", $e->getMessage());
            throw new \RuntimeException($m);
        }
    }

    public function delete(string $url)
    {
        try {
            $res = $this->http->request("DELETE", $url, ['headers' => $this->getDefaultHeaders()]);
            $contentType = $res->getHeader('Content-Type');
            if (!empty($contentType) && $contentType[0] === 'application/json') {
                return \GuzzleHttp\json_decode((string) $res->getBody(), true);
            }
            return (string) $res->getBody();
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
