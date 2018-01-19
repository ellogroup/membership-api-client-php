<?php

namespace MembershipClient\Api;

use MembershipClient\Model\CancellationReason;
use MembershipClient\Model\CancellationReasonFactory;

class CancellationReasons
{
    const URL = "/cancellation-reason";
    private $http;
    private $factory;

    public function __construct(
        HttpClient $http,
        CancellationReasonFactory $factory
    ) {
        $this->http = $http;
        $this->factory = $factory;
    }

    public function fetch(array $options = [])
    {
        $q = $this->parseOptions($options);
        $response = $this->http->get(self::URL, $q);
        $out = $this->factory->fromResponse($response);
        return $out;
    }

    private function parseOptions(array $options)
    {
        $q = [];
        if (isset($options['active']) && $options['active']) {
            $q['active'] = $options['active'];
        }
        if (isset($options['internal']) && $options['internal']) {
            $q['internal'] = $options['internal'];
        }
        return $q;
    }
}
