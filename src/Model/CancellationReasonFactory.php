<?php

namespace MembershipClient\Model;

class CancellationReasonFactory
{
    public function fromResponse(array $response)
    {
        $out = array_map(
            function ($reason) {
                $children = [];
                if (!empty($reason['children'])) {
                    $children = $this->fromResponse($reason['children']);
                }
                return $this->build($reason, $children);
            },
            $response
        );
        return $out;
    }

    public function build(array $reason, array $children)
    {
        return new CancellationReason(
            $reason['id'],
            $reason['reason'],
            $children
        );
    }
}
