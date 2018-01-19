<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use MembershipClient\Api\HttpClient;
use MembershipClient\Api\JwtToken;
use GuzzleHttp\Psr7\Response;

class HttpClientTest extends TestCase
{
    public function setUp()
    {
        $this->http = $this->createMock(Client::class);
        $this->token = $this->createMock(JwtToken::class);
        $this->SUT = new HttpClient($this->http, $this->token);
    }

    public function testGetPassesConsumerToken()
    {
        $res = $this->createMock(Response::class);
        $url = "example.com";
        $q = ['test' => 1];

        $this->token->method("generate")->willReturn("chicken");
        $this->http
            ->expects($this->once())
            ->method("request")
            ->with("GET", $url, ['headers' => ['X-Consumer-Token' => 'chicken'], 'query' => ['test' => 1]])
            ->willReturn($res);

        $this->SUT->get($url, $q);
    }

    public function testPostPassesConsumerToken()
    {
        $res = $this->createMock(Response::class);
        $url = "example.com";
        $body = 'test';

        $this->token->method("generate")->willReturn("horse");
        $this->http
            ->expects($this->once())
            ->method("request")
            ->with("POST", $url, ['headers' => ['X-Consumer-Token' => 'horse'], 'body' => 'test'])
            ->willReturn($res);

        $this->SUT->post($url, $body);
    }
}
