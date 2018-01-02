<?php

namespace MembershipClient\Api;

use MembershipClient\Model\CancellationReason;

class CancellationReasons
{
    const URL = "/cancellation-reason";
    private $http;

    public function __construct(
        HttpClient $http
    ) {
        $this->http = $http;
    }

    public function fetch(array $options = [])
    {
        $q = $this->parseOptions($options);
        $response = $this->http->get(self::URL, $q);
        $out = $this->formatResponse($response);
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

    private function formatResponse(array $response)
    {
        $out = array_map(
            function ($reason) {
                $children = [];
                if (!empty($reason['children'])) {
                    $children = $this->formatResponse($reason['children']);
                }
                return new CancellationReason(
                    $reason['id'],
                    $reason['reason'],
                    $children
                );
            },
            $response
        );
        return $out;
    }
}
