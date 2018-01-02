<?php

namespace MembershipClient;

use GuzzleHttp\Client as Guzzle;
use MembershipClient\Api\CancellationReasons;
use MembershipClient\Api\Membership;
use MembershipClient\Api\CardUsage;
use MembershipClient\Api\Customer;
use MembershipClient\Api\HttpClient;

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

    public static function init()
    {
        $guzzle = new Guzzle([
            'base_uri' => 'https://membership.dcg.local',
            "verify" => false
        ]);
        $http = new HttpClient($guzzle);

        $cancellationReasons = new CancellationReasons($http);
        $cardUsage = new CardUsage($http);
        $customer = new Customer($http);
        $membership = new Membership($http, $cardUsage);
        return new Client(
            $cancellationReasons,
            $membership,
            $customer
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
