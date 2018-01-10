<?php

namespace MembershipClient\Api;

use MembershipClient\Model\Customer as CustomerModel;
use MembershipClient\Model\CustomerFactory;

class Customer
{
    private $http;
    private $id;
    private $factory;

    public function __construct(
        HttpClient $http,
        CustomerFactory $factory
    ) {
        $this->http = $http;
        $this->factory = $factory;
    }

    public function fetch()
    {
        $url = sprintf("/customer");
        if ($this->id) {
            $url = sprintf("%s/%s", $url, $this->id);
            $response = $this->http->get($url);
            return $this->factory->build($response);
        }
        $response = $this->http->get($url);
        $out = $this->factory->fromResponse($response);
        return $out;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
