<?php

namespace MembershipClient\Model;

class CancellationReason
{
    private $id;
    private $reason;
    private $children;

    public function __construct(
        string $id,
        string $reason,
        array $children = []
    ) {
        $this->id = $id;
        $this->reason = $reason;
        $this->children = $children;
    }
}
