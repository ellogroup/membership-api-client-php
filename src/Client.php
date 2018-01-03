<?php

namespace MembershipClient;

use GuzzleHttp\Client as Guzzle;
use MembershipClient\Api\CancellationReasons;
use MembershipClient\Api\Membership;
use MembershipClient\Api\CardUsage;
use MembershipClient\Api\Customer;
use MembershipClient\Api\HttpClient;
use MembershipClient\Api\JwtToken;
use MembershipClient\Model\CancellationReasonFactory;

class Client
{
    private function __construct(
        CancellationReasons $cancellationReasons,
        Membership $membership,
        Customer $customer
    ) {
        $this->cancellationReasons = $cancellationReasons;
        $this->membership = $membership;
        $this->customer = $customer;
    }

    public static function init(
        string $baseUrl,
        string $privateKey
    ) {
        $guzzle = new Guzzle([
            'base_uri' => $baseUrl,
            "verify" => false
        ]);
        $token = new JwtToken($privateKey, 1);
        $http = new HttpClient($guzzle, $token);
        $cardUsage = new CardUsage($http);
        return new Client(
            new CancellationReasons($http, new CancellationReasonFactory()),
            new Membership($cardUsage),
            new Customer($http)
        );
    }

    public function cancellationReasons()
    {
        return $this->cancellationReasons;
    }

    public function membership($id)
    {
        $this->membership->setId($id);
        return $this->membership;
    }

    public function customer($id = null)
    {
        $this->customer->setId($id);
        return $this->customer;
    }
}
