<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use MembershipClient\Api\HttpClient;
use MembershipClient\Api\JwtToken;
use GuzzleHttp\Psr7\Response;

class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    private $SUT;

    /**
     * @var Client|PHPUnit_Framework_MockObject_MockObject
     */
    private $http;

    /**
     * @var JwtToken|PHPUnit_Framework_MockObject_MockObject
     */
    private $token;

    public function setUp()
    {
        $this->http = $this->createMock(Client::class);
        $this->token = $this->createMock(JwtToken::class);
        $this->SUT = new HttpClient($this->http, $this->token);
    }

    public function testGetPassesConsumerToken()
    {
        $res = new Response(200, [], "{}");
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
        $res = new Response(200, [], "{}");
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

    public function testPatchPassesConsumerToken()
    {
        $res = new Response(200, [], "{}");
        $url = "example.com";
        $body = 'test';

        $this->token->method("generate")->willReturn("horse");
        $this->http
            ->expects($this->once())
            ->method("request")
            ->with("PATCH", $url, ['headers' => ['X-Consumer-Token' => 'horse'], 'body' => 'test'])
            ->willReturn($res);

        $this->SUT->patch($url, $body);
    }

    public function testDeletePassesConsumerToken()
    {
        $res = new Response(204, [], "");
        $url = "example.com";

        $this->token->method("generate")->willReturn("horse");
        $this->http
            ->expects($this->once())
            ->method("request")
            ->with("DELETE", $url, ['headers' => ['X-Consumer-Token' => 'horse']])
            ->willReturn($res);

        $this->SUT->delete($url);
    }

    public function testGetThrowsExceptionOnBadJsonResponse()
    {
        $res = new Response(200, [], "invalid json");
        $url = "example.com";
        $q = ['test' => 1];
        $this->token->method("generate")->willReturn("chicken");
        $this->http->method("request")->willReturn($res);

        $this->expectException(\InvalidArgumentException::class);

        $this->SUT->get($url, $q);
    }

    public function testPostThrowsExceptionOnBadJsonResponse()
    {
        $res = new Response(200, [], "invalid json");
        $url = "example.com";
        $body = 'test';
        $this->token->method("generate")->willReturn("chicken");
        $this->http->method("request")->willReturn($res);

        $this->expectException(\InvalidArgumentException::class);

        $this->SUT->post($url, $body);
    }

    public function testPatchThrowsExceptionOnBadJsonResponse()
    {
        $res = new Response(200, [], "invalid json");
        $url = "example.com";
        $body = 'test';
        $this->token->method("generate")->willReturn("chicken");
        $this->http->method("request")->willReturn($res);

        $this->expectException(\InvalidArgumentException::class);

        $this->SUT->patch($url, $body);
    }

    public function testDeleteBubblesExceptions()
    {
        $this->http
            ->expects($this->once())
            ->method("request")
            ->willThrowException(new Exception('oops'));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('failed request: oops');

        $this->SUT->delete('blah');
    }
}
