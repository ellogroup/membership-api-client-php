<?php

namespace MembershipClient\Api;

use MembershipClient\Model\Customer as CustomerModel;

class Customer
{
    private $http;
    private $id;

    public function __construct(
        HttpClient $http
    ) {
        $this->http = $http;
    }

    public function fetch()
    {
        $url = sprintf("/customer");
        if ($this->id) {
            $url = sprintf("%s/%s", $url, $this->id);
            $response = $this->http->get($url);
            return $this->factory($response);
        }
        $response = $this->http->get($url);
        $out = $this->formatResponse($response);
        return $out;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    private function formatResponse(array $response)
    {
        $out = array_map(
            function ($customer) {
                return $this->factory($customer);
            },
            $response
        );
        return $out;
    }

    private function factory($customer)
    {
        return new CustomerModel(
            $customer['id'],
            $customer['title'],
            $customer['firstName'],
            $customer['lastName'],
            $customer['emailAddress'],
            $customer['phoneNumber'],
            $customer['mobilePhone']
        );
    }
}
