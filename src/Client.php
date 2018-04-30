<?php

namespace MembershipClient;

use GuzzleHttp\Client as Guzzle;
use MembershipClient\Api\CancellationReasons;
use MembershipClient\Api\Membership;
use MembershipClient\Api\CardUsage;
use MembershipClient\Api\Customer;
use MembershipClient\Api\HttpClient;
use MembershipClient\Api\JwtToken;
use MembershipClient\Model\AddressFactory;
use MembershipClient\Model\CancellationReasonFactory;
use MembershipClient\Model\CardUsageFactory;
use MembershipClient\Model\CustomerFactory;
use MembershipClient\Model\MembershipFactory;

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
        string $privateKey,
        int $consumerId = 1, // Have to have 1 as default to keep backwards compatibility with v1.0.0 and v1.0.1
        array $additionalHeaders = []
    ) {
        $guzzle = new Guzzle([
            'base_uri' => $baseUrl,
            "verify" => false
        ]);
        $token = new JwtToken($privateKey, $consumerId);
        $http = new HttpClient($guzzle, $token, $additionalHeaders);
        $cardUsage = new CardUsage($http, new CardUsageFactory());
        return new Client(
            new CancellationReasons($http, new CancellationReasonFactory()),
            new Membership($http, $cardUsage),
            new Customer($http, new CustomerFactory(
                new AddressFactory(),
                new MembershipFactory()
            ))
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
