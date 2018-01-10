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
use MembershipClient\Model\CardUsageFactory;
use MembershipClient\Model\CustomerFactory;

class Client
{
    private $cancellationReasonsApi;
    private $membershipApi;
    private $customerApi;

    private function __construct(
        CancellationReasons $cancellationReasonsApi,
        Membership $membershipApi,
        Customer $customerApi
    ) {
        $this->cancellationReasonsApi = $cancellationReasonsApi;
        $this->membershipApi = $membershipApi;
        $this->customerApi = $customerApi;
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
        $cardUsage = new CardUsage($http, new CardUsageFactory());
        return new Client(
            new CancellationReasons($http, new CancellationReasonFactory()),
            new Membership($cardUsage),
            new Customer($http, new CustomerFactory())
        );
    }

    public function cancellationReasons()
    {
        return $this->cancellationReasonsApi;
    }

    public function membership(string $id)
    {
        $this->membershipApi->setId($id);
        return $this->membershipApi;
    }

    public function customer(string $id = null)
    {
        $this->customerApi->setId($id);
        return $this->customerApi;
    }
}
